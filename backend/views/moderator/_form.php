<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Moderator $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="moderator-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'memberID')->textInput() ?>

    <?= $form->field($model, 'pending_questionset_number')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
