<?php

/** @var yii\web\View  $this  */
use backend\models\GameAssignments;
use backend\models\CourseStudent;
use yii\helpers\Html;
// Get the request object
$userId = Yii::$app->session->get('user_id');
$courses= CourseStudent::find()->where(['Student_ID' => $userId])->all();
$this->title = 'Your Assignments';
?>
<div class="site-courses">
    <div class="row">
        <div class="col-md-12">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>
    <div class="row">
        <?php foreach ($courses as $course):
            $assignment=GameAssignments::find()->where(['course_code' => $course->CourseID])->one();
            if($assignment!==null){
                $interface=$assignment->interface_type;
                $duedate=$assignment->due_date;
                $mode=$assignment->game_mode;
                $questionset=$assignment->question_setID;
                $interface=$assignment->interface_type;
            }
            ?>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><?php 
                        if($assignment!==null)
                        echo "Game Mode::".$mode ?></h4>
                    </div>
                    <div class="panel-body">
                        <p><?php if($assignment!==null)
                        echo "Expiry Date::".$duedate ?></p>
                        <p><?php if($assignment!==null)
                        echo "Course Code::".$course->CourseID ?></p>
                        <p>
                            <?php if ($assignment !== null): ?>
                            <?= Html::a('<span class="glyphicon glyphicon-info-sign"></span> Play-->', ['quiz', 'qid' => $questionset, 'inid' => $interface], ['class' => 'btn btn-default']) ?>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
