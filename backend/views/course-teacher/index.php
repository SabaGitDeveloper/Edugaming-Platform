<?php

use backend\models\CourseTeacher;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\CourseTeacherSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Course Teachers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-teacher-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Course Teacher', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idCourse_Teacher',
            'Course_id',
            'Teacher_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, CourseTeacher $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idCourse_Teacher' => $model->idCourse_Teacher]);
                 }
            ],
        ],
    ]); ?>


</div>
