<?php

use backend\models\QuestionSet;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\QuestionSetSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Question Sets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-set-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Question Sets', ['create', 'course_code' => $model->course_code, 'topic_id' => $model->topicID], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'question_setID',
            'topicID',
            'course_code',
            'date_created',
            'created_by',
            //'difficulty_level',
            //'status',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, QuestionSet $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'question_setID' => $model->question_setID]);
                 }
            ],
        ],
    ]); ?>


</div>
