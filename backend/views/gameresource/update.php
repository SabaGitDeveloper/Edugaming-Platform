<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Gameresource $model */

$this->title = 'Update Gameresource: ' . $model->idGameResource;
$this->params['breadcrumbs'][] = ['label' => 'Gameresources', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idGameResource, 'url' => ['view', 'idGameResource' => $model->idGameResource]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="gameresource-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
