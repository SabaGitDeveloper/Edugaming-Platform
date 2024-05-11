<?php
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Join Requests';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'student_id',
        'firstname',
        'course_id',
        'status',
        'date_sent',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{approve} {reject}',
            'buttons' => [
                'approve' => function ($url, $model, $key) {
                    return Html::a('Approve', ['approve', 'id' => $model->idStudent_join_Requests], ['class' => 'btn btn-success']);
                },
                'reject' => function ($url, $model, $key) {
                    return Html::a('Reject', ['reject', 'id' => $model->idStudent_join_Requests], ['class' => 'btn btn-danger']);
                },
            ],
        ],
    ],
]) ?>
