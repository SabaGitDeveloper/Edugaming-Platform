<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\GameInterfaceResource $model */

$this->title = $model->idGameInterfaceResource;
$this->params['breadcrumbs'][] = ['label' => 'Game Interface Resources', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="game-interface-resource-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idGameInterfaceResource' => $model->idGameInterfaceResource], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idGameInterfaceResource' => $model->idGameInterfaceResource], [
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
            'idGameInterfaceResource',
            'Resource_id',
            'Interface_id',
        ],
    ]) ?>

</div>
