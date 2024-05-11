<?php
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $course frontend\models\Courses */
/* @var $teacherDetails array */

$this->title = 'Teachers Teaching the Course';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<p><strong>Course:</strong> <?= Html::encode($course->course_name) ?></p>

<?= GridView::widget([
    'dataProvider' => new \yii\data\ArrayDataProvider([
        'allModels' => $teacherDetails,
    ]),
    'columns' => [
        'name',
        'qualification',
        'speciality',
        'experience',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{join}',
            'buttons' => [
                'join' => function ($url, $model, $key) {
                    return Html::a('Join Request', ['site/join-request', 'teacherId' => $model['id']], ['class' => 'btn btn-success']);
                },
            ],
        ],
    ],
]) ?>
