<?php

use backend\models\Moderator;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\ModeratorSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Moderators';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="moderator-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Moderator', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'memberID',
            'pending_questionset_number',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Moderator $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'memberID' => $model->memberID]);
                 }
            ],
        ],
    ]); ?>


</div>
