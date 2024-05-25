<?php

use backend\models\Questions;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\QuestionsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Questions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="questions-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Questions', ['create', 'question_setID' => $model->QuestionSet], ['class' => 'btn btn-success']) ?>
    </p>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Question No</th>
                <th>Question Statement</th>
                <th>Hint</th>
                <th>View</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dataProvider->models as $index => $model): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= Html::encode($model->QuestionNo) ?></td>
                    <td><?= Html::a(Html::encode($model->QuestionStatement), ['options/index', 'questionNo' => $model->QuestionNo]) ?></td>
                    <td><?= Html::encode($model->Hints) ?></td>
                    <td><?= Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['view', 'QuestionNo' => $model->QuestionNo], ['title' => 'View']) ?></td> 
                    <td><?= Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['update', 'QuestionNo' => $model->QuestionNo], ['title' => 'Edit']) ?></td>
                    <td><?= Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'QuestionNo' => $model->QuestionNo], [
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
