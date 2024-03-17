<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\CoursesModerated $model */

$this->title = 'Update Courses Moderated: ' . $model->idCourses_Moderated;
$this->params['breadcrumbs'][] = ['label' => 'Courses Moderateds', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idCourses_Moderated, 'url' => ['view', 'idCourses_Moderated' => $model->idCourses_Moderated]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="courses-moderated-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
