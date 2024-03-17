<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Teacher $model */

$this->title = 'Update Teacher: ' . $model->memberID;
$this->params['breadcrumbs'][] = ['label' => 'Teachers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->memberID, 'url' => ['view', 'memberID' => $model->memberID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="teacher-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
