<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\CoursesModerated $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="courses-moderated-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idCourses_Moderated')->textInput() ?>

    <?= $form->field($model, 'course_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'moderator_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
