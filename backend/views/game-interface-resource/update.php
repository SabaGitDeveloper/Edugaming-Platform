<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\GameInterfaceResource $model */

$this->title = 'Update Game Interface Resource: ' . $model->idGameInterfaceResource;
$this->params['breadcrumbs'][] = ['label' => 'Game Interface Resources', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idGameInterfaceResource, 'url' => ['view', 'idGameInterfaceResource' => $model->idGameInterfaceResource]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="game-interface-resource-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
