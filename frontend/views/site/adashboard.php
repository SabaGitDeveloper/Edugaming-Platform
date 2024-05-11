<?php

/** @var yii\web\View $this */ 

use yii\helpers\Html;

$this->title = 'Admin Dashboard';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-dashboard">
   <h1><?= Html::encode($this->title) ?></h1>
   <h4>Welcome <?= Yii::$app->user->identity->username ?></h4>
   <p>Here you can manage courses, requests and more.</p>
    <?= Html::a('Explore Courses', ['admin/courses'], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Manage Requests', ['admin/requests'], ['class' => 'btn btn-primary']) ?>
</div>

