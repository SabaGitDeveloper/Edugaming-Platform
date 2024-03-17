<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\CourseStudent $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="course-student-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'CourseID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Student_ID')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
