<?php use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $courses backend\models\Courses[] */

$this->title = 'All Courses';
$this->params['breadcrumbs'][] = $this->title;

$buttons = [];
if (!Yii::$app->user->isGuest && Yii::$app->user->identity->user_type === 'teacher'){
    $buttons['class'] = 'yii\grid\ActionColumn';
    $buttons['template'] = '{view}';
    $buttons['buttons'] = [
        'view' => function ($url, $model) {
            return Html::a('Join Request', ['teacher-approval-requests/create', 'course_code' => $model->course_code], ['class' => 'btn btn-success']);
        }
    ];
} else {
    $buttons['class'] = 'yii\grid\ActionColumn';
    $buttons['template'] = '{view}';
    $buttons['buttons'] = [
        'view' => function ($url, $model) {
            return Html::a('View', ['guest/course-teachers', 'course_code' => $model->course_code], ['class' => 'btn btn-primary']);
        }
    ];
}

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
            $buttons,
        ],
    ]) ?>

</div>
