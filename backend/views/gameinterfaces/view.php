<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Gameinterfaces $model */

$this->title = $model->idGameInterfaces;
$this->params['breadcrumbs'][] = ['label' => 'Gameinterfaces', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="gameinterfaces-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idGameInterfaces' => $model->idGameInterfaces], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idGameInterfaces' => $model->idGameInterfaces], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idGameInterfaces',
            'GameInterfaceDes',
            'InterfaceType',
        ],
    ]) ?>

</div>
