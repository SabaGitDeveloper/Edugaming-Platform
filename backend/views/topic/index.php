<?php

use backend\models\Topic;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\TopicSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Topics';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="topic-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Topic', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'topicID',
            'topic_title',
            'topic_description:ntext',
            'learning_target:ntext',
            'parent_id',
            //'has_children',
            //'course_code',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Topic $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'topicID' => $model->topicID]);
                 }
            ],
        ],
    ]); ?>


</div>
