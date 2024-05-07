<?php

/** @var yii\web\View  $this  */
use backend\models\StudentJoinRequests;
use common\models\User;
/* @var $courses array */

use yii\helpers\Html;
$userId = Yii::$app->session->get('user_id');
$StudentRequests = StudentJoinRequests::find()->where(['student_id' => $userId])->all();
$this->title = 'Your Requests';
?>
<div class="site-courses">
    <div class="row">
        <div class="col-md-12">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>
    <div class="row">
        <?php foreach ($StudentRequests as $sr):
            $status=$sr->status;
            if($status=="pending"):
                $teacherId=$sr->teacher_id;
                $teacher = User::find()->where(['id' => $teacherId])->one();
                $teachername=$teacher->username;
                $courseid=$sr->course_id;
            ?>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><?php echo $courseid ?></h4>
                    </div>
                    <div class="panel-body">
                        <p><?php echo $teachername ?></p>
                        <p><?php echo $status ?></p>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= Html::a('Place New Request', ['newrequest'], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
</div>
