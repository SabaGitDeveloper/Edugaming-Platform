<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\OptionsPuzzle $model */

$this->title = 'Create Options Puzzle';
$this->params['breadcrumbs'][] = ['label' => 'Options Puzzles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="options-puzzle-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
