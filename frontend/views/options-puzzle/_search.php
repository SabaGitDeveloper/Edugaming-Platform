<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\OptionsPuzzleSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="options-puzzle-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'optionID') ?>

    <?= $form->field($model, 'questionNo') ?>

    <?= $form->field($model, 'option_text') ?>

    <?= $form->field($model, 'sequence_number') ?>

    <?= $form->field($model, 'display_number') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
