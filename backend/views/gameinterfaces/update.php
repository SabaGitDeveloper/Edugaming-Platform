<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Gameinterfaces $model */

$this->title = 'Update Gameinterfaces: ' . $model->idGameInterfaces;
$this->params['breadcrumbs'][] = ['label' => 'Gameinterfaces', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idGameInterfaces, 'url' => ['view', 'idGameInterfaces' => $model->idGameInterfaces]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="gameinterfaces-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
