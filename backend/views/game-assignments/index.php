<?php

use backend\models\GameAssignments;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\GameAssignmentsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Game Assignments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="game-assignments-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Game Assignments', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'assignmentID',
            'course_code',
            'assigned_by',
            'date_assigned',
            'due_date',
            //'game_mode',
            //'interface_type',
            //'question_setID',
            //'topicId',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, GameAssignments $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'assignmentID' => $model->assignmentID]);
                 }
            ],
        ],
    ]); ?>


</div>
