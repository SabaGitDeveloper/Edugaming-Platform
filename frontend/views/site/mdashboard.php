<?php

/** @var yii\web\View $this */ 

use yii\helpers\Html;

$this->title = 'Moderator-Dashboard';
?>
<div class="site-dashboard">
    <div class="row">
        <div class="col-md-12 text-center">
            <h2>Welcome <?= Yii::$app->user->identity->username ?></h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Courses</h3>
                </div>
                <div class="panel-body">
                    <p><?= Html::a('View Courses', ['moderator/courses'], ['class' => 'btn btn-primary']) ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Requests</h3>
                </div>
                <div class="panel-body">
                    <p><?= Html::a('View Requests', ['moderator/requests'], ['class' => 'btn btn-primary']) ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Pending Approvals</h3>
                </div>
                <div class="panel-body">
                    <p><?= Html::a('View Pending Approval Requests', ['moderator/approvals'], ['class' => 'btn btn-primary']) ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
