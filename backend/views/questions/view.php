<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Questions $model */

$this->title = $model->QuestionNo;
$this->params['breadcrumbs'][] = ['label' => 'Questions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="questions-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'QuestionNo' => $model->QuestionNo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'QuestionNo' => $model->QuestionNo], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('View Options', ['options/index', 'QuestionNo' => $model->QuestionNo], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'QuestionNo',
            'QuestionStatement',
            'Hints',
            'QuestionSet',
        ],
    ]) ?>

</div>
