<?php

use backend\models\Courses;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\CoursesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Courses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="courses-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Courses', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'course_code',
            'course_name',
            'course_description:ntext',
            'SubjectId',
            'coursescol',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Courses $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'course_code' => $model->course_code]);
                 }
            ],
        ],
    ]); ?>


</div>
