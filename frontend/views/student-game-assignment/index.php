<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $course_code string */

$this->title = 'Student Game Assignments for Course: ' . $course_code;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-game-assignment-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'], 
        [
            'attribute' => 'assignmentID',
            'label' => 'Assignment ID',
            'format' => 'raw',
            'value' => function ($model) {
                return Html::a($model->assignmentID, ['scores', 'Assignment_Id' => $model->assignmentID]);
            },
        ],
        [
            'attribute' => 'due_date',
            'label' => 'Due Date',
            'value' => 'due_date', 
        ],
        [
            'attribute' => 'game_mode',
            'label' => 'Game Mode',
            'value' => 'game_mode', 
        ],
        [
            'attribute' => 'interface_type',
            'label' => 'Interface Type',
            'value' => 'interface_type', 
        ],
    ],
]); ?>

</div>
