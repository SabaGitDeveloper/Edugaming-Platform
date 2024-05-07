<?php

/** @var yii\web\View  $this  */
use backend\models\ModeratorApprovalRequests;
use common\models\User;
/* @var $courses array */

use yii\helpers\Html;
$userId = Yii::$app->session->get('user_id');
$ModeratorRequests = ModeratorApprovalRequests::find()->where(['moderator_id' => $userId])->all();
$this->title = 'Your Requests';
?>
<div class="site-courses">
    <div class="row">
        <div class="col-md-12">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>
    <div class="row">
        <?php foreach ($ModeratorRequests as $mr):
            $status=$mr->status;
            //if($status=="pending"):
                $adminId=$mr->admin_id;
                $admin = User::find()->where(['id' => $adminId])->one();
                $adminname=$admin->username;
                $courseid=$mr->course_id;
                $edu=$mr->qualifications;
                $exp=$mr->experience; 
            ?>
                <div class="col-md-4">
                    <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><?php echo $courseid ?></h4>
                    </div>
                    <div class="panel-body">
                        <p><?php echo $adminname ?></p>
                        <p><?php echo $status ?></p>
                        <p><?= "Education: ".$edu ?></p>
                        <p><?= "Experience: ".$exp ?></p>
                    </div>
                    </div>
                </div>
            
        <?php endforeach; ?>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= Html::a('Place New Request', ['newrequest'], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
</div>
