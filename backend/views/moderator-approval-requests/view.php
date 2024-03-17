<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\ModeratorApprovalRequests $model */

$this->title = $model->idModerator_Approval_Requests;
$this->params['breadcrumbs'][] = ['label' => 'Moderator Approval Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="moderator-approval-requests-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idModerator_Approval_Requests' => $model->idModerator_Approval_Requests], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idModerator_Approval_Requests' => $model->idModerator_Approval_Requests], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idModerator_Approval_Requests',
            'moderator_id',
            'admin_id',
            'status',
            'firstname',
            'lastname',
            'phoneNo',
            'qualifications:ntext',
            'experience:ntext',
            'date_sent',
            'course_id',
        ],
    ]) ?>

</div>
