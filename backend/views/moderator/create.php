<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Moderator $model */

$this->title = 'Create Moderator';
$this->params['breadcrumbs'][] = ['label' => 'Moderators', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="moderator-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
