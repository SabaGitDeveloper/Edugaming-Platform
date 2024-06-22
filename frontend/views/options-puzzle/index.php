<?php

use backend\models\OptionsPuzzle;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\OptionsPuzzleSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Options Puzzles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="options-puzzle-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Options Puzzle', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'optionID',
            'questionNo',
            'option_text:ntext',
            'sequence_number',
            'display_number',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, OptionsPuzzle $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'optionID' => $model->optionID]);
                 }
            ],
        ],
    ]); ?>


</div>
