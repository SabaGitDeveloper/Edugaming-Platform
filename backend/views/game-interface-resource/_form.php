<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\GameInterfaceResource $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="game-interface-resource-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Resource_id')->textInput() ?>

    <?= $form->field($model, 'Interface_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
