<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\StudentJoinRequests $model */

$this->title = 'Update Student Join Requests: ' . $model->idStudent_join_Requests;
$this->params['breadcrumbs'][] = ['label' => 'Student Join Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idStudent_join_Requests, 'url' => ['view', 'idStudent_join_Requests' => $model->idStudent_join_Requests]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="student-join-requests-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
