<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Topic $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="topic-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'topic_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'topic_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'learning_target')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'parent_id')->textInput() ?>

    <?= $form->field($model, 'has_children')->textInput() ?>

    <?= $form->field($model, 'course_code')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
