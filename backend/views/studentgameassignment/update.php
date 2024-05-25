<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Studentgameassignment $model */

$this->title = 'Update Studentgameassignment: ' . $model->idStudentGameAssignment;
$this->params['breadcrumbs'][] = ['label' => 'Studentgameassignments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idStudentGameAssignment, 'url' => ['view', 'idStudentGameAssignment' => $model->idStudentGameAssignment]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="studentgameassignment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
