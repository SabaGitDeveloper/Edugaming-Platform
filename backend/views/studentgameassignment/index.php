<?php

use backend\models\Studentgameassignment;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\StudentgameassignmentSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Studentgameassignments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="studentgameassignment-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Studentgameassignment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idStudentGameAssignment',
            'Accuracy',
            'Speed',
            'tries',
            'CourseID',
            //'StudentID',
            //'AssignmentId',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Studentgameassignment $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idStudentGameAssignment' => $model->idStudentGameAssignment]);
                 }
            ],
        ],
    ]); ?>


</div>
