<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\QuestionSet $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="question-set-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'topicID')->textInput() ?>

    <?= $form->field($model, 'course_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_created')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'difficulty_level')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'approval_status')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
