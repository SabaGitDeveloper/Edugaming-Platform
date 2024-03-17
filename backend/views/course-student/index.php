<?php

use backend\models\CourseStudent;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\CourseStudentSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Course Students';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-student-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Course Student', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idCourse_Student',
            'CourseID',
            'Student_ID',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, CourseStudent $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idCourse_Student' => $model->idCourse_Student]);
                 }
            ],
        ],
    ]); ?>


</div>
