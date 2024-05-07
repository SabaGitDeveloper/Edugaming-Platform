<?php

/** @var yii\web\View  $this  */
use backend\models\TeacherApprovalRequests;
use common\models\User;
use yii\widgets\ActiveForm;
/* @var $courses array */

use yii\helpers\Html;
$userId = Yii::$app->session->get('user_id');
$TeacherRequests = TeacherApprovalRequests::find()->where(['status' => 'pending'])->all();

$this->title = 'Pending Approvals';
?>
<div class="site-courses">
    <div class="row">
        <div class="col-md-12">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>
    <div class="row">
 ?>">
        <?php foreach ($TeacherRequests as $tr):
        
            $status=$tr->status;
            $tarID=$tr->idTeacher_Approval_Requests;
            ?>
            <?php if($status==="pending"):

                $teacherId=$tr->teacher_id;
                $teacher = User::find()->where(['id' => $teacherId])->one();
                $tname=$teacher->username;
                $courseid=$tr->course_id; 
                $edu=$tr->qualifications;
                $exp=$tr->experience;
            ?>
            <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><?= $courseid ?></h4>
                        </div>
                        <div class="panel-body">
                            <p><?= $tname ?></p>
                            <p><?= $status ?></p>
                            <p><?= "Education: ".$edu ?></p>
                            <p><?= "Experience: ".$exp ?></p>
                        </div>
                        <div class="panel-footer">
                            <?php $form = ActiveForm::begin(['action' => ['moderator/submit2'], 'method' => 'post']); ?>
                            <input type="hidden" name="idTeacher_Approval_Requests" value="<?= $tarID ?>">
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
