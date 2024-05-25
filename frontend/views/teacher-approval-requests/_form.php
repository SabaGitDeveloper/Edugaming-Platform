<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\TeacherApprovalRequests $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="teacher-approval-requests-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'phoneNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'qualifications')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'experience')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
