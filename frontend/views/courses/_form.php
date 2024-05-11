<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\courses $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="courses-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'course_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'course_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'course_description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
