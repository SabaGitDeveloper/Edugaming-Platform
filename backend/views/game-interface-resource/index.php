<?php

use backend\models\GameInterfaceResource;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\GameInterfaceResourceSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Game Interface Resources';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="game-interface-resource-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Game Interface Resource', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idGameInterfaceResource',
            'Resource_id',
            'Interface_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, GameInterfaceResource $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idGameInterfaceResource' => $model->idGameInterfaceResource]);
                 }
            ],
        ],
    ]); ?>


</div>
