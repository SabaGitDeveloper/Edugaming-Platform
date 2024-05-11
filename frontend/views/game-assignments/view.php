<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\GameAssignments $model */

$this->title = $model->assignmentID;
$this->params['breadcrumbs'][] = ['label' => 'Game Assignments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="game-assignments-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'assignmentID' => $model->assignmentID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'assignmentID' => $model->assignmentID], [
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
            'assignmentID',
            'course_code',
            'assigned_by',
            'date_assigned',
            'due_date',
            'game_mode',
            'interface_type',
            'question_setID',
            'topicId',
        ],
    ]) ?>

</div>
