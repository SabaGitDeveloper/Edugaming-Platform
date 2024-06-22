<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\OptionsPuzzle $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="options-puzzle-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'optionID')->textInput() ?>

    <?= $form->field($model, 'questionNo')->textInput() ?>

    <?= $form->field($model, 'option_text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'sequence_number')->textInput() ?>

    <?= $form->field($model, 'display_number')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
