<?php

/** @var yii\web\View  $this  */
use backend\models\Courses;
use backend\models\CourseStudent;
use backend\models\StudentJoinRequests;
use yii\helpers\Html;
// Get the request object
$userId = Yii::$app->session->get('user_id');
$courses= CourseStudent::find()->where(['Student_ID' => $userId])->all();
$newCourses = Courses::find()
    ->where(['not in', 'id', array_column($courses, 'id')])
    ->all();
$previousRequested = StudentJoinRequests::find()
    ->where(['student_id' => $userId])
    ->andWhere(['IN', 'status', ['pending', 'approved']])
    ->select('course_id')
    ->column();
$this->title = 'New Courses';
?>
<div class="site-courses">
    <div class="row">
        <div class="col-md-12">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>
    <div class="row">
        <?php foreach ($newCourses as $nc):
            $code=$nc->course_code;
            $title=$nc->course_name;
            $descrip=$nc->course_description;
            // Skip the course if it's already requested by the moderator
            if (in_array($code, $previousRequested)) {
                continue;
            }
            ?>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><?php 
                        if($newCourses!==null)
                        echo $title ?></h4>
                    </div>
                    <div class="panel-body">
                        <p><?php if($newCourses!==null)
                        echo "Course Code: ".$code ?></p>
                        <p><?php echo "Course Details: ".$descrip ?></p>
                        <p>
                            <?php if ($newCourses !== null): ?>
                            <?= Html::a('<span class="glyphicon glyphicon-info-sign"></span> Send Request-->', ['/student/createrequest', 'cid' => $code], ['class' => 'btn btn-default']) ?>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
