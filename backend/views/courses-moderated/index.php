<?php

use backend\models\CoursesModerated;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\CoursesModeratedSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Courses Moderateds';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="courses-moderated-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Courses Moderated', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idCourses_Moderated',
            'course_id',
            'moderator_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, CoursesModerated $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idCourses_Moderated' => $model->idCourses_Moderated]);
                 }
            ],
        ],
    ]); ?>


</div>
