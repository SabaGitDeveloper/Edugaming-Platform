<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\OptionsPuzzle $model */

$this->title = $model->optionID;
$this->params['breadcrumbs'][] = ['label' => 'Options Puzzles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="options-puzzle-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'optionID' => $model->optionID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'optionID' => $model->optionID], [
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
            'optionID',
            'questionNo',
            'option_text:ntext',
            'sequence_number',
            'display_number',
        ],
    ]) ?>

</div>
