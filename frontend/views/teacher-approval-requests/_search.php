<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\TeacherApprovalRequestsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="teacher-approval-requests-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idTeacher_Approval_Requests') ?>

    <?= $form->field($model, 'teacher_id') ?>

    <?= $form->field($model, 'Moderator_id') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'date_sent') ?>

    <?php // echo $form->field($model, 'phoneNo') ?>

    <?php // echo $form->field($model, 'qualifications') ?>

    <?php // echo $form->field($model, 'experience') ?>

    <?php // echo $form->field($model, 'course_id') ?>

    <?php // echo $form->field($model, 'Speciality') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
