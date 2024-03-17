<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\TeacherApprovalRequests $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="teacher-approval-requests-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idTeacher_Approval_Requests')->textInput() ?>

    <?= $form->field($model, 'teacher_id')->textInput() ?>

    <?= $form->field($model, 'Moderator_id')->textInput() ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
