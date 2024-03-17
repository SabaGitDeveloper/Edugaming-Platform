<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\CoursesModerated $model */

$this->title = $model->idCourses_Moderated;
$this->params['breadcrumbs'][] = ['label' => 'Courses Moderateds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="courses-moderated-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idCourses_Moderated' => $model->idCourses_Moderated], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idCourses_Moderated' => $model->idCourses_Moderated], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('View QuestionSets', ['question-set/index', 'course_code'=>$model->course_id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idCourses_Moderated',
            'course_id',
            'moderator_id',
        ],
    ]) ?>

</div>
