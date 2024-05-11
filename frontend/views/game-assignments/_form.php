<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\GameAssignments $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="game-assignments-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'due_date')->textInput() ?>

    <?= $form->field($model, 'game_mode')->dropDownList([ 'learning' => 'Learning', 'quiz' => 'Quiz', ], ['prompt' => 'Select Game Mode']) ?>

    <?= $form->field($model, 'interface_type')->dropDownList([1 => 'Bubble Pop', 2 => 'Bubble Pop with Multiple Options',3 => 'Assembling',
], ['prompt' => 'Select Interface Type']) ?>


    <?= $form->field($model, 'question_setID')->dropDownList($questionsets, ['prompt' => 'Select Question Set']) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
