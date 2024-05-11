<?php

use yii\helpers\Html;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\Courses $course */
/** @var app\models\Topic[] $topics */

$this->title = $course->course_code;
$this->params['breadcrumbs'][] = ['label' => 'Courses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $course->course_code, 'url' => ['view', 'course_code' => $course->course_code]];
$this->params['breadcrumbs'][] = 'Topics';
\yii\web\YiiAsset::register($this);
?>
<div class="courses-topics">

    <h1><?= Html::encode($this->title) ?> - Topics</h1>

    <p>
        <?= Html::a('Back to Course', ['view', 'course_code' => $course->course_code], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= GridView::widget([
    'dataProvider' => new \yii\data\ArrayDataProvider([
        'allModels' => $topics,
    ]),
    'columns' => [
        [
            'attribute' => 'topic_title',
            'format' => 'raw',
            'value' => function ($model) use ($course) {
                return Html::a(Html::encode($model->topic_title), ['question-set/index', 'course_code' => $course->course_code, 'topic_id' => $model->topicID]);
            },
        ],
    ],
]); ?>


</div>
