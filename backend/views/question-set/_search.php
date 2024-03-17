<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\QuestionSetSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="question-set-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'question_setID') ?>

    <?= $form->field($model, 'topicID') ?>

    <?= $form->field($model, 'course_code') ?>

    <?= $form->field($model, 'date_created') ?>

    <?= $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'difficulty_level') ?>

    <?php // echo $form->field($model, 'approval_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
