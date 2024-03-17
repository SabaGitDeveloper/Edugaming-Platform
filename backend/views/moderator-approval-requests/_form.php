<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\ModeratorApprovalRequests $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="moderator-approval-requests-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idModerator_Approval_Requests')->textInput() ?>

    <?= $form->field($model, 'moderator_id')->textInput() ?>

    <?= $form->field($model, 'admin_id')->textInput() ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
