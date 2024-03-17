<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\GameAssignments $model */

$this->title = 'Update Game Assignments: ' . $model->assignmentID;
$this->params['breadcrumbs'][] = ['label' => 'Game Assignments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->assignmentID, 'url' => ['view', 'assignmentID' => $model->assignmentID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="game-assignments-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
