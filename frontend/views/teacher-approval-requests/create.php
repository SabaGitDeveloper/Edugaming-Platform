<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\TeacherApprovalRequests $model */

$this->title = 'Create Teacher Approval Requests';
$this->params['breadcrumbs'][] = ['label' => 'Teacher Approval Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-approval-requests-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
