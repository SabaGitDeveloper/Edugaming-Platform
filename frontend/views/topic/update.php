<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Topic $model */

$this->title = 'Update Topic: ' . $model->topicID;
$this->params['breadcrumbs'][] = ['label' => 'Topics', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->topicID, 'url' => ['view', 'topicID' => $model->topicID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="topic-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
