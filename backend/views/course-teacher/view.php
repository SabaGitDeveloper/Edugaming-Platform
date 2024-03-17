<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\CourseTeacher $model */

$this->title = $model->idCourse_Teacher;
$this->params['breadcrumbs'][] = ['label' => 'Course Teachers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="course-teacher-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idCourse_Teacher' => $model->idCourse_Teacher], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idCourse_Teacher' => $model->idCourse_Teacher], [
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
            'idCourse_Teacher',
            'Course_id',
            'Teacher_id',
            'is_active',
        ],
    ]) ?>

</div>
