<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Gameresource $model */

$this->title = 'Create Gameresource';
$this->params['breadcrumbs'][] = ['label' => 'Gameresources', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gameresource-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
