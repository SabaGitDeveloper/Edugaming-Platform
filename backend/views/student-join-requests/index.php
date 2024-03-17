<?php

use backend\models\StudentJoinRequests;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\StudentJoinRequestsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Student Join Requests';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-join-requests-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Student Join Requests', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idStudent_join_Requests',
            'student_id',
            'teacher_id',
            'course_id',
            'status',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, StudentJoinRequests $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idStudent_join_Requests' => $model->idStudent_join_Requests]);
                 }
            ],
        ],
    ]); ?>


</div>
