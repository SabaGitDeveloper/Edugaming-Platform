<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\QuestionSet $model */

$this->title = 'Create Question Set';
$this->params['breadcrumbs'][] = ['label' => 'Question Sets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-set-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
