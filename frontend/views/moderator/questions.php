<?php

use backend\models\Options;
use Symfony\Component\Console\Question\Question;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Questions;
/** @var yii\web\View  $this  */
$request = Yii::$app->request;
$questionid= $request->get('qsid');
$questions = Questions::find()->where(['QuestionSet' => $questionid])->all();
$this->title = 'Questions';
?>
<h1><?= Html::encode($this->title) ?></h1>
<div class="panel-heading">
    <h3 class="panel-title"><?php echo "QuestionSetID:".$questionid ?></h3>
</div>
<?php $form = ActiveForm::begin(['action' => ['moderator/submit'], 'method' => 'post']); ?>
<input type="hidden" name="questionSetId" value="<?= $questionid ?>">
<?php foreach ($questions as $question): 
    $options=Options::find()->where(['questionNo' => $question->QuestionNo])->all();
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title"><?= $question->QuestionStatement ?></h4>
            <h6 class="panel-title"><?= "Hint: ".$question->Hints ?></h6>
        </div>
        <div class="panel-body">
            <?php foreach ($options as $option): 
                $qNo=$option->questionNo;
                if ($option->option_type === 'correct'): ?>
                    <p class="text-success"><?= Html::encode("Correct Option: " . $option->option_text) ?></p>
                <?php else: ?>
                    <p class="text-danger"><?= Html::encode("Incorrect Option: " . $option->option_text) ?></p>
                <?php endif; ?>
            <?php endforeach; ?>
            <!-- Textarea for user comments -->
            <?= Html::textarea("Questions[{$question->QuestionNo}][comments]", '', ['rows' => 2]) ?>
            
        </div>
    </div>
<?php endforeach; ?>

<!-- Buttons to accept or reject -->
<?= Html::submitButton('Accept All', ['class' => 'btn btn-success', 'name' => 'action', 'value' => 'accept']) ?>
<?= Html::submitButton('Reject All', ['class' => 'btn btn-danger', 'name' => 'action', 'value' => 'reject']) ?>
<?php ActiveForm::end(); ?>

