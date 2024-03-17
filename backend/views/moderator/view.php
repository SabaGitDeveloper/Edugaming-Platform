<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Moderator $model */

$this->title = $model->memberID;
$this->params['breadcrumbs'][] = ['label' => 'Moderators', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="moderator-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'memberID' => $model->memberID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'memberID' => $model->memberID], [
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
            'memberID',
            'pending_questionset_number',
        ],
    ]) ?>

</div>
