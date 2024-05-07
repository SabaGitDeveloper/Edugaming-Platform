<?php

/** @var yii\web\View  $this  */
use backend\models\ModeratorApprovalRequests;
use common\models\User;
use yii\widgets\ActiveForm;
/* @var $courses array */

use yii\helpers\Html;
$userId = Yii::$app->session->get('user_id');
$ModeratorRequests = ModeratorApprovalRequests::find()->where(['status' => 'pending'])->all();

$this->title = 'Your Requests';
?>
<div class="site-courses">
    <div class="row">
        <div class="col-md-12">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>
    <div class="row">
 ?>">
        <?php foreach ($ModeratorRequests as $mr):
        
            $status=$mr->status;
            $marID=$mr->idModerator_Approval_Requests;
            ?>
            <?php if($status=="pending"):

                $moderatorId=$mr->moderator_id;
                $moderator = User::find()->where(['id' => $moderatorId])->one();
                $mname=$moderator->username;
                $courseid=$mr->course_id; 
                $edu=$mr->qualifications;
                $exp=$mr->experience;
            ?>
            <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><?= $courseid ?></h4>
                        </div>
                        <div class="panel-body">
                            <p><?= $mname ?></p>
                            <p><?= $status ?></p>
                            <p><?= "Education: ".$edu ?></p>
                            <p><?= "Experience: ".$exp ?></p>
                        </div>
                        <div class="panel-footer">
                            <?php $form = ActiveForm::begin(['action' => ['admin/submit'], 'method' => 'post']); ?>
                            <input type="hidden" name="idModerator_Approval_Requests" value="<?= $marID ?>">
                            <?= Html::submitButton('Accept', ['class' => 'btn btn-success', 'name' => 'action', 'value' => 'accept']) ?>
                            <?= Html::submitButton('Reject', ['class' => 'btn btn-danger', 'name' => 'action', 'value' => 'reject']) ?>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
                
            <?php endif; ?>
        <?php endforeach; ?>
    </div>


</div>
