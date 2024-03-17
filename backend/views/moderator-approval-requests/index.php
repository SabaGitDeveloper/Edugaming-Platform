<?php

use backend\models\ModeratorApprovalRequests;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\ModeratorApprovalRequestsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Moderator Approval Requests';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="moderator-approval-requests-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Moderator Approval Requests', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idModerator_Approval_Requests',
            'moderator_id',
            'admin_id',
            'status',
            'firstname',
            //'lastname',
            //'phoneNo',
            //'qualifications:ntext',
            //'experience:ntext',
            //'date_sent',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, ModeratorApprovalRequests $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idModerator_Approval_Requests' => $model->idModerator_Approval_Requests]);
                 }
            ],
        ],
    ]); ?>


</div>
