<?php
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'My Courses';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="game-assignments-courses">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'Course_id',
                'label' => 'Course Code',
            ],
            [
                'attribute' => 'course_name',
                'label' => 'Course Name',
                'format' => 'raw',
                'value' => function($model) {
                    return Html::a(
                        Html::encode($model->course->course_name),
                        ['student-game-assignment/index', 'course_code' => $model->course->course_code]
                    );
                },
            ],
        ],
    ]); ?>
</div>
