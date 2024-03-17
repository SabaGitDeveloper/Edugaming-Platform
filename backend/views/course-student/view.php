<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\CourseStudent $model */

$this->title = $model->idCourse_Student;
$this->params['breadcrumbs'][] = ['label' => 'Course Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="course-student-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idCourse_Student' => $model->idCourse_Student], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idCourse_Student' => $model->idCourse_Student], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('View GameAssignments', ['game-assignments/index', 'idCourse_Student' => $model->idCourse_Student], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idCourse_Student',
            'CourseID',
            'Student_ID',
        ],
    ]) ?>

</div>
