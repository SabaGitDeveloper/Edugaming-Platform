<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\ModeratorApprovalRequests $model */

$this->title = 'Create Moderator Approval Requests';
$this->params['breadcrumbs'][] = ['label' => 'Moderator Approval Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="moderator-approval-requests-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
