<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\QuestionSet $model */

$this->title = $model->question_setID;
$this->params['breadcrumbs'][] = ['label' => 'Question Sets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="question-set-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'question_setID' => $model->question_setID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'question_setID' => $model->question_setID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('View Questions', ['questions/create', 'question_setID' => $model->question_setID], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'question_setID',
            'topicID',
            'course_code',
            'date_created',
            'created_by',
            'difficulty_level',
            'approval_status',
        ],
    ]) ?>

</div>
