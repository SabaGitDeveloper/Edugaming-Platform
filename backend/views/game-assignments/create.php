<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\GameAssignments $model */

$this->title = 'Create Game Assignments';
$this->params['breadcrumbs'][] = ['label' => 'Game Assignments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="game-assignments-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
