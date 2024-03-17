<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\ModeratorApprovalRequests $model */

$this->title = 'Update Moderator Approval Requests: ' . $model->idModerator_Approval_Requests;
$this->params['breadcrumbs'][] = ['label' => 'Moderator Approval Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idModerator_Approval_Requests, 'url' => ['view', 'idModerator_Approval_Requests' => $model->idModerator_Approval_Requests]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="moderator-approval-requests-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
