<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\OptionsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="options-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'optionID') ?>

    <?= $form->field($model, 'questionNo') ?>

    <?= $form->field($model, 'option_text') ?>

    <?= $form->field($model, 'option_type') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
