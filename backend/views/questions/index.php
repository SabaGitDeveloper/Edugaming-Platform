<?php

use backend\models\Questions;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\QuestionsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Questions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="questions-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Questions', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'QuestionNo',
            'QuestionStatement',
            'Hints',
            'QuestionSet',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Questions $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'QuestionNo' => $model->QuestionNo]);
                 }
            ],
        ],
    ]); ?>


</div>
