<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Questions $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="questions-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'QuestionNo')->textInput() ?>

    <?= $form->field($model, 'QuestionStatement')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Hints')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'QuestionSet')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
