<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\CourseStudent $model */

$this->title = 'Update Course Student: ' . $model->idCourse_Student;
$this->params['breadcrumbs'][] = ['label' => 'Course Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idCourse_Student, 'url' => ['view', 'idCourse_Student' => $model->idCourse_Student]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="course-student-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
