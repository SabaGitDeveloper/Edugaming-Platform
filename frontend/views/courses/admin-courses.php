<?php

use backend\models\Courses;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\CoursesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Courses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="courses-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Courses', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Course Code</th>
                <th>Course Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dataProvider->models as $index => $model): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= Html::encode($model->course_code) ?></td>
                    <td><?= Html::a(Html::encode($model->course_name), ['topic/course-topics', 'course_code' => $model->course_code]) ?></td>
                    <td>
                        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['view', 'course_code' => $model->course_code], ['title' => 'View']) ?>   
                        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['update', 'course_code' => $model->course_code], ['title' => 'Edit']) ?>
                        <?= Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'course_code' => $model->course_code], [
                            'title' => 'Delete',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>
