<?php

use backend\models\Gameresource;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\GameresourceSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Gameresources';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gameresource-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Gameresource', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idGameResource',
            'Resource_data',
            'ResourceFile',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Gameresource $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idGameResource' => $model->idGameResource]);
                 }
            ],
        ],
    ]); ?>


</div>
