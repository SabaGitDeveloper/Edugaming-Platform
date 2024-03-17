<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\GameInterfaceResource $model */

$this->title = 'Create Game Interface Resource';
$this->params['breadcrumbs'][] = ['label' => 'Game Interface Resources', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="game-interface-resource-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
