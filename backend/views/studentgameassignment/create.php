<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Studentgameassignment $model */

$this->title = 'Create Studentgameassignment';
$this->params['breadcrumbs'][] = ['label' => 'Studentgameassignments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="studentgameassignment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
