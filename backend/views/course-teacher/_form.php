<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\CourseTeacher $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="course-teacher-form">

    <?php $form = ActiveForm::begin(); ?>

    <!--<?= $form->field($model, 'idCourse_Teacher')->textInput() ?>-->

    <?= $form->field($model, 'Course_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Teacher_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
