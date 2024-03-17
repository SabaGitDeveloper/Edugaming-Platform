<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Student $model */

$this->title = 'Update Student: ' . $model->memberID;
$this->params['breadcrumbs'][] = ['label' => 'Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->memberID, 'url' => ['view', 'memberID' => $model->memberID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="student-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
