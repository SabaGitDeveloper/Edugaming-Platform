<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\CourseTeacher $model */

$this->title = 'Update Course Teacher: ' . $model->idCourse_Teacher;
$this->params['breadcrumbs'][] = ['label' => 'Course Teachers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idCourse_Teacher, 'url' => ['view', 'idCourse_Teacher' => $model->idCourse_Teacher]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="course-teacher-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
