<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\TeacherApprovalRequests $model */

$this->title = $model->idTeacher_Approval_Requests;
$this->params['breadcrumbs'][] = ['label' => 'Teacher Approval Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="teacher-approval-requests-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idTeacher_Approval_Requests' => $model->idTeacher_Approval_Requests], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idTeacher_Approval_Requests' => $model->idTeacher_Approval_Requests], [
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
            'idTeacher_Approval_Requests',
            'teacher_id',
            'Moderator_id',
            'status',
            'date_sent',
            'phoneNo',
            'qualifications:ntext',
            'experience:ntext',
            'course_id',
        ],
    ]) ?>

</div>
