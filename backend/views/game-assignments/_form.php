<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\GameAssignments $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="game-assignments-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'course_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'assigned_by')->textInput() ?>

    <?= $form->field($model, 'date_assigned')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'due_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'game_mode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'interface_type')->textInput() ?>

    <?= $form->field($model, 'question_setID')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
