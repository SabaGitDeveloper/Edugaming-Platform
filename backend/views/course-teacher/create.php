<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\CourseTeacher $model */

$this->title = 'Create Course Teacher';
$this->params['breadcrumbs'][] = ['label' => 'Course Teachers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-teacher-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
