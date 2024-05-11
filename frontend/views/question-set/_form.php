<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\QuestionSet $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="question-set-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'difficulty_level')->dropDownList([ 'easy' => 'Easy', 'medium' => 'Medium', 'hard' => 'Hard', ], ['prompt' => '']) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
