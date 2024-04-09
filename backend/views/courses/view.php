<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


use backend\models\CourseTeacher;
use backend\models\CoursesModerated;
// Instantiate a new CourseTeacher object
$modelT = new CourseTeacher();
// Instantiate a new CourseModerated object
$modelM = new CoursesModerated();
/** @var yii\web\View $this */
/** @var backend\models\Courses $model */
/** @var backend\models\CourseTeacher $modelT*/
/** @var backend\models\CoursesModerated $modelM*/
$this->title = $model->course_code;
$teacherId = $modelT->find()->select('Teacher_id')->where(['Course_id' => $model->course_code])->scalar();
$ModeratorId = $modelM->find()->select('moderator_id')->where(['course_id' => $model->course_code])->scalar();
$AdminId=10;


$this->params['breadcrumbs'][] = ['label' => 'Courses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="courses-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'course_code' => $model->course_code], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'course_code' => $model->course_code], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('View Topics', ['topic/index', 'course_code' => $model->course_code], ['class' => 'btn btn-success']) ?>
        <?= Html::a('View GameAssignments', ['game-assignments/index', 'course_code' => $model->course_code], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'course_code',
            'course_name',
            'course_description:ntext',
        ],
    ]) ?>

</div>
<div class="row">
    <div class="col-md-4">
        <p>
            <?= Html::a('Send Student Join Request', ['/student-join-requests/create','course_id' => $model->course_code,'teacher_id'=>$teacherId], ['class' => 'btn btn-link']) ?>
            <?= Html::a('Send Teacher Approval Request', ['/teacher-approval-requests/create','course_id' => $model->course_code,'moderator_id'=>$ModeratorId], ['class' => 'btn btn-link']) ?>
            <?= Html::a('Send Moderator Approval Request', ['/moderator-approval-requests/create','course_id' => $model->course_code,'admin_id'=>$AdminId], ['class' => 'btn btn-link']) ?>
        </p>
    </div>
    <div class="col-md-4">
        <p>
            <?= Html::a('View Student Join Request', ['/student-join-requests/index','course_id' => $model->course_code,'teacher_id'=>$teacherId], ['class' => 'btn btn-link']) ?>
            <?= Html::a('View Teacher Approval Request', ['/teacher-approval-requests/index','course_id' => $model->course_code,'moderator_id'=>$ModeratorId], ['class' => 'btn btn-link']) ?>
            <?= Html::a('View Moderator Approval Request', ['/moderator-approval-requests/index','course_id' => $model->course_code,'admin_id'=>$AdminId], ['class' => 'btn btn-link']) ?>
        </p>
    </div>
</div>
