<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Questions $model */

$this->title = 'Update Questions: ' . $model->QuestionNo;
$this->params['breadcrumbs'][] = ['label' => 'Questions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->QuestionNo, 'url' => ['view', 'QuestionNo' => $model->QuestionNo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="questions-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
