<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Topic $model */

$this->title = $model->topicID;
$this->params['breadcrumbs'][] = ['label' => 'Topics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="topic-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'topicID' => $model->topicID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'topicID' => $model->topicID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
                <?= Html::a('View QuestionSets', ['question-set/create', 'topicID' => $model->topicID], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'topicID',
            'topic_title',
            'topic_description:ntext',
            'learning_target:ntext',
            'parent_id',
            'has_children',
            'course_code',
        ],
    ]) ?>

</div>
