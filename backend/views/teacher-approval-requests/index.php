<?php

use backend\models\TeacherApprovalRequests;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\TeacherApprovalRequestsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Teacher Approval Requests';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-approval-requests-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Teacher Approval Requests', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idTeacher_Approval_Requests',
            'teacher_id',
            'Moderator_id',
            'status',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, TeacherApprovalRequests $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idTeacher_Approval_Requests' => $model->idTeacher_Approval_Requests]);
                 }
            ],
        ],
    ]); ?>


</div>
