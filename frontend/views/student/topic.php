<?php

/** @var yii\web\View  $this  */
use backend\models\Topic;
use yii\helpers\Html;
// Get the request object
$request = Yii::$app->request;
$courseid= $request->get('id');
$topics = Topic::find()->where(['course_code' => $courseid])->all();
$this->title = 'Topics';
?>
<div class="site-courses">
    <div class="row">
        <div class="col-md-12">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>
    <div class="row">
        <?php foreach ($topics as $topic):
            $topicid=$topic->topicID;
            $topicname=$topic->topic_title;
            $topicdescription=$topic->topic_description;
            $target=$topic->learning_target;
            ?>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><?php echo $topicname ?></h4>
                    </div>
                    <div class="panel-body">
                        <p><?php echo $topicdescription ?></p>
                        <p><?php echo $target ?></p>
                        <p>
                            <?= Html::a('<span class="glyphicon glyphicon-info-sign"></span> View Assignments-->', ['assignment', 'id' => $topicid], ['class' => 'btn btn-default']) ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
