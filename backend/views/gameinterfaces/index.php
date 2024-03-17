<?php

use backend\models\Gameinterfaces;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\GameinterfacesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Gameinterfaces';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gameinterfaces-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Gameinterfaces', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idGameInterfaces',
            'GameInterfaceDes',
            'InterfaceType',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Gameinterfaces $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idGameInterfaces' => $model->idGameInterfaces]);
                 }
            ],
        ],
    ]); ?>


</div>
