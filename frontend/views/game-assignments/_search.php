<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\GameAssignmentsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="game-assignments-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'assignmentID') ?>

    <?= $form->field($model, 'course_code') ?>

    <?= $form->field($model, 'assigned_by') ?>

    <?= $form->field($model, 'date_assigned') ?>

    <?= $form->field($model, 'due_date') ?>

    <?php // echo $form->field($model, 'game_mode') ?>

    <?php // echo $form->field($model, 'interface_type') ?>

    <?php // echo $form->field($model, 'question_setID') ?>

    <?php // echo $form->field($model, 'topicId') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
