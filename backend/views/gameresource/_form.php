<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Gameresource $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="gameresource-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Resource_data')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ResourceFile')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
