<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Gameinterfaces $model */

$this->title = 'Create Gameinterfaces';
$this->params['breadcrumbs'][] = ['label' => 'Gameinterfaces', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gameinterfaces-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
