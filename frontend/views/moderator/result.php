<?php

use yii\helpers\Html;
/** @var yii\web\View  $this  */
$this->title = 'Quiz Result';
?>
<h1><?= Html::encode($this->title) ?></h1>
<p>Score: <?= $score ?> / <?= $totalQuestions ?></p>