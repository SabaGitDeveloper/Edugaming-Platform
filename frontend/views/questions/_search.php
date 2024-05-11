<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\QuestionsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="questions-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'QuestionNo') ?>

    <?= $form->field($model, 'QuestionStatement') ?>

    <?= $form->field($model, 'Hints') ?>

    <?= $form->field($model, 'QuestionSet') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
