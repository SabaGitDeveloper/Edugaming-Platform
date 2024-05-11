<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $courses backend\models\Courses[] */

$this->title = 'All Courses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-courses">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => new \yii\data\ArrayDataProvider([
            'allModels' => $courses,
        ]),
        'columns' => [
            'course_code',
            'course_name',
            'course_description:ntext',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('View', ['guest/course-teachers', 'course_code' => $model->course_code], ['class' => 'btn btn-primary']);
                    },
                ],
            ],
        ],
    ]) ?>

</div>
