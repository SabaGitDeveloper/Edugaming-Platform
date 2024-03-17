<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\ModeratorApprovalRequestsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="moderator-approval-requests-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idModerator_Approval_Requests') ?>

    <?= $form->field($model, 'moderator_id') ?>

    <?= $form->field($model, 'admin_id') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'firstname') ?>

    <?php // echo $form->field($model, 'lastname') ?>

    <?php // echo $form->field($model, 'phoneNo') ?>

    <?php // echo $form->field($model, 'qualifications') ?>

    <?php // echo $form->field($model, 'experience') ?>

    <?php // echo $form->field($model, 'date_sent') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
