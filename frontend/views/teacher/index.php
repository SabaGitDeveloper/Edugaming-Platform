<?php

use yii\helpers\Html;
$this->title = 'Teacher Dashboard';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-dashboard">
    <h1><?= Html::encode($this->title) ?></h1>
    <h4>Welcome <?= Yii::$app->user->identity->username ?></h4>
    <p>Here, you can manage your courses, view student progress, and more.</p>
    <?= Html::a('Explore Courses', ['guest/courses'], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Manage Requests', ['student-join-requests/index'], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Check Courses', ['courses/teacher-courses'], ['class' => 'btn btn-primary']) ?>
    <!--<?= Html::a('View Students', ['courses/teacher-courses'], ['class' => 'btn btn-primary']) ?>-->
    <?= Html::a('View Student Scores', ['game-assignments/courses'], ['class' => 'btn btn-primary']) ?>


</div>

