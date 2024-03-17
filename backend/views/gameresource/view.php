<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Gameresource $model */

$this->title = $model->idGameResource;
$this->params['breadcrumbs'][] = ['label' => 'Gameresources', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="gameresource-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idGameResource' => $model->idGameResource], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idGameResource' => $model->idGameResource], [
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
            'idGameResource',
            'Resource_data',
            'ResourceFile',
        ],
    ]) ?>

</div>
