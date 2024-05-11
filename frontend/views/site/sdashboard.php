<?php

/** @var yii\web\View $this */ 

use yii\helpers\Html;

$this->title = 'Student Dashboard';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-dashboard">
   <h1><?= Html::encode($this->title) ?></h1>
   <h4>Welcome <?= Yii::$app->user->identity->username ?></h4>
   <p>Here you can explore your courses, view and play your game-assignments, place requests and more.</p>
        <?= Html::a('Explore Courses', ['student/courses'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Manage Requests', ['student/request'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Check Assignments', ['student/assgall'], ['class' => 'btn btn-primary']) ?>
</div>
