<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Options $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="options-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'optionID')->textInput() ?>

    <?= $form->field($model, 'questionNo')->textInput() ?>

    <?= $form->field($model, 'option_text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'option_type')->dropDownList([ 'correct' => 'Correct', 'incorrect' => 'Incorrect', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
