<?php

use backend\models\Topic;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\TopicSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Topics';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="topic-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Topic', ['create','course_code'=>$model->course_code], ['class' => 'btn btn-success']) ?>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Topic ID</th>
                <th>Topic Name</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dataProvider->models as $index => $model): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= Html::encode($model->topicID) ?></td>
                    <td><?= Html::a(Html::encode($model->topic_title), ['question-set/topic-question-set', 'course_code' => $model->course_code, 'topicID' => $model->topicID]) ?></td>

                    <td>
                        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['view', 'topicID' => $model->topicID], ['title' => 'View']) ?>
                        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['update', 'topicID' => $model->topicID], ['title' => 'Edit']) ?>
                        <?= Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete',  'topicID' => $model->topicID], [
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
