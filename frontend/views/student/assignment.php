<?php

/** @var yii\web\View  $this  */
use backend\models\GameAssignments;
use yii\helpers\Html;
// Get the request object
$request = Yii::$app->request;
$topicid= $request->get('id');
$assignments = GameAssignments::find()->where(['topicID' => $topicid])->all();
$this->title = 'Assignments';
?>
<div class="site-courses">
    <div class="row">
        <div class="col-md-12">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>
    <div class="row">
        <?php foreach ($assignments as $assignment):
            $questionset=$assignment->question_setID;
            $interface=$assignment->interface_type;
            $duedate=$assignment->due_date;
            $mode=$assignment->game_mode;
            ?>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><?php echo "Game Mode::".$mode ?></h4>
                    </div>
                    <div class="panel-body">
                        <p><?php echo "Expiry Date::".$duedate ?></p>
                        <p>
                            <?= Html::a('<span class="glyphicon glyphicon-info-sign"></span> Play-->', ['quiz', 'qid' => $questionset,'inid' => $interface], ['class' => 'btn btn-default']) ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
