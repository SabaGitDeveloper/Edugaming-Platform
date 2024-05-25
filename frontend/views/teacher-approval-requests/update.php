<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\TeacherApprovalRequests $model */

$this->title = 'Update Teacher Approval Requests: ' . $model->idTeacher_Approval_Requests;
$this->params['breadcrumbs'][] = ['label' => 'Teacher Approval Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idTeacher_Approval_Requests, 'url' => ['view', 'idTeacher_Approval_Requests' => $model->idTeacher_Approval_Requests]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="teacher-approval-requests-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
