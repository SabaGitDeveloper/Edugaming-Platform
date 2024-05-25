<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Studentgameassignment $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="studentgameassignment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Accuracy')->textInput() ?>

    <?= $form->field($model, 'Speed')->textInput() ?>

    <?= $form->field($model, 'tries')->textInput() ?>

    <?= $form->field($model, 'CourseID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StudentID')->textInput() ?>

    <?= $form->field($model, 'AssignmentId')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
