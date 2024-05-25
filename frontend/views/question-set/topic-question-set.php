<?php

use backend\models\QuestionSet;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\QuestionSetSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Question Sets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-set-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Question Sets', ['create', 'course_code' => $model->course_code, 'topicID' => $model->topicID], ['class' => 'btn btn-primary']) ?>
    </p>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Question Set ID</th>
                <th>Topic ID</th>
                <th>Course Code</th>
                <th>Edit</th>
                <th>Assign</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dataProvider->models as $index => $model): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= Html::a(Html::encode($model->question_setID), ['questions/set-questions', 'question_setID' => $model->question_setID]) ?></td>
                    <td><?= Html::encode($model->topicID) ?></td>
                    <td><?= Html::encode($model->course_code) ?></td>
                    <td>
                    <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['view', 'question_setID' => $model->question_setID], ['title' => 'View']) ?>   
                        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['update', 'question_setID' => $model->question_setID], ['title' => 'Edit']) ?>
                        <?= Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete',  'question_setID' => $model->question_setID], [
                            'title' => 'Delete',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]) ?>
                        
                    </td>
                    <td>
                        <?= Html::a('Assign Games', ['game-assignments/create','course_code'=>$model->course_code,'topicID'=>$model->topicID,'question_setID' => $model->question_setID], ['class' => 'btn btn-success']) ?>    </p>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>
