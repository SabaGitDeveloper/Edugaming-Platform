<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Options $model */

$this->title = 'Update Options: ' . $model->optionID;
$this->params['breadcrumbs'][] = ['label' => 'Options', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->optionID, 'url' => ['view', 'optionID' => $model->optionID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="options-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
