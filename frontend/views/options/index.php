<?php

use backend\models\Options;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\OptionsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Options';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="options-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Options', ['create'], ['class' => 'btn btn-success']) ?>
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
            'option_type',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Options $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'optionID' => $model->optionID]);
                 }
            ],
        ],
    ]); ?>


</div>
