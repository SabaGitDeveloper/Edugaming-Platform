<?php

/** @var yii\web\View $this */ 

use yii\helpers\Html;

$this->title = 'Moderator Dashboard';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-dashboard">
   <h1><?= Html::encode($this->title) ?></h1>
   <h4>Welcome <?= Yii::$app->user->identity->username ?></h4>
   <p>Here you can manage courses, requests and more.</p>
    <?= Html::a('Explore Courses', ['moderator/courses'], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Manage Requests', ['moderator/request'], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Check Pending Approval Requests', ['moderator/approvals'], ['class' => 'btn btn-primary']) ?>
</div>
