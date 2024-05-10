<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\StudentJoinRequests $model */

$this->title = 'Create Student Join Requests';
$this->params['breadcrumbs'][] = ['label' => 'Student Join Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-join-requests-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
