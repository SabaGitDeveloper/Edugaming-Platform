<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\StudentJoinRequests $model */

$this->title = $model->idStudent_join_Requests;
$this->params['breadcrumbs'][] = ['label' => 'Student Join Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="student-join-requests-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idStudent_join_Requests' => $model->idStudent_join_Requests], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idStudent_join_Requests' => $model->idStudent_join_Requests], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idStudent_join_Requests',
            'student_id',
            'teacher_id',
            'course_id',
            'status',
            'date_sent',
            'firstname',
            'lastname',
            'phoneNo',
            'qualifications:ntext',
        ],
    ]) ?>

</div>
