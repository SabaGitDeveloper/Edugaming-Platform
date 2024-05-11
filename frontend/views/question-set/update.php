<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\QuestionSet $model */

$this->title = 'Update Question Set: ' . $model->question_setID;
$this->params['breadcrumbs'][] = ['label' => 'Question Sets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->question_setID, 'url' => ['view', 'question_setID' => $model->question_setID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="question-set-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
