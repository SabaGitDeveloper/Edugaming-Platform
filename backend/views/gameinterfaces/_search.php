<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\GameinterfacesSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="gameinterfaces-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idGameInterfaces') ?>

    <?= $form->field($model, 'GameInterfaceDes') ?>

    <?= $form->field($model, 'InterfaceType') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
