<?php

/** @var yii\web\View  $this  */
use backend\models\Courses;
/* @var $courses array */

use yii\helpers\Html;
$userId = Yii::$app->session->get('user_id');
$courses = Courses::find()->all();
$this->title = 'Your Courses';
?>
<div class="site-courses">
    <div class="row">
        <div class="col-md-12">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>
    <div class="row">
        <?php foreach ($courses as $course):
            $courseid=$course->course_code;
            $coursename=$course->course_name;
            $coursedescription=$course->course_description;
            ?>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><?php echo $courseid ?></h4>
                    </div>
                    <div class="panel-body">
                        <p><?php echo $coursedescription ?></p>
                        <p><?php echo $coursename ?></p>
                        <p>
                            <?= Html::a('<span class="glyphicon glyphicon-info-sign"></span> View Topics-->', ['topic', 'id' => $courseid], ['class' => 'btn btn-default']) ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <?= Html::a('<span class="glyphicon glyphicon-info-sign"></span> Add New Course', ['courses/create'], ['class' => 'btn btn-primary']) ?>
    </div>
</div>
