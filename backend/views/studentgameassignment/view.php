<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Studentgameassignment $model */

$this->title = $model->idStudentGameAssignment;
$this->params['breadcrumbs'][] = ['label' => 'Studentgameassignments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="studentgameassignment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idStudentGameAssignment' => $model->idStudentGameAssignment], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idStudentGameAssignment' => $model->idStudentGameAssignment], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idStudentGameAssignment',
            'Accuracy',
            'Speed',
            'tries',
            'CourseID',
            'StudentID',
            'AssignmentId',
        ],
    ]) ?>

</div>
