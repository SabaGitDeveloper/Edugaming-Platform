<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\StudentgameassignmentSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="studentgameassignment-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idStudentGameAssignment') ?>

    <?= $form->field($model, 'Accuracy') ?>

    <?= $form->field($model, 'Speed') ?>

    <?= $form->field($model, 'tries') ?>

    <?= $form->field($model, 'CourseID') ?>

    <?php // echo $form->field($model, 'StudentID') ?>

    <?php // echo $form->field($model, 'AssignmentId') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
