<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Gameinterfaces $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="gameinterfaces-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'GameInterfaceDes')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'InterfaceType')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
