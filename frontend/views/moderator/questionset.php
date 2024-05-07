<?php

/** @var yii\web\View  $this  */
use backend\models\QuestionSet;
use yii\helpers\Html;
// Get the request object
$request = Yii::$app->request;
$topicid= $request->get('id');
$questionsets = QuestionSet::find()->where(['topicID' => $topicid])->all();
$this->title = 'QuestionSets';
?>
<div class="site-courses">
    <div class="row">
        <div class="col-md-12">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>
    <div class="row">
        <?php foreach ($questionsets as $qs): ?>
            <?php 
            $status=$qs->status;
            if($status=="pending"):
                $id=$qs->question_setID;
                $createdby=$qs->created_by;
                $level=$qs->difficulty_level;
                //$mode=$qs->interface_type; will be needed later when applying puzzle interface
            ?>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><?php echo "QuestionSetID:".$id ?></h4>
                    </div>
                    <div class="panel-body">
                        <p><?php echo "Created By:".$createdby ?></p>
                        <p><?php echo "Difficulty Level:".$level ?></p>
                        <p>
                        <?= Html::a('<span class="glyphicon glyphicon-info-sign"></span> View Questions-->', ['questions', 'qsid' => $id], ['class' => 'btn btn-default']) ?>
                        </p>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>
