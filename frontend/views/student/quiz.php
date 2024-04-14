<?php

use backend\models\Options;
use Symfony\Component\Console\Question\Question;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Questions;
/** @var yii\web\View  $this  */
$request = Yii::$app->request;
$questionid= $request->get('qid');
$questions = Questions::find()->where(['QuestionSet' => $questionid])->all();
$this->title = 'Quiz';
?>
<h1><?= Html::encode($this->title) ?></h1>
<?php $form = ActiveForm::begin(['action' => ['student/submit'], 'method' => 'post']); ?>
<?php foreach ($questions as $question): 
    $options=Options::find()->where(['questionNo' => $question->QuestionNo])->all();
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?= $question->QuestionStatement ?></h3>
        </div>
        <div class="panel-body">
            <?php foreach ($options as $option): 
                $qNo=$option->questionNo;
                $answers = Options::find()
                ->where(['option_type' => 'correct'])
                ->andWhere(['questionNo' => $qNo])
                ->all();
                foreach($answers as $answer):
                    $correctOption=$answer->option_text;
                    ?>
                        <?= Html::hiddenInput("correctAnswers[$qNo]", $correctOption) ?>
                    <?php endforeach;
            ?>
                <div class="radio">
                    <label>
                        <?= Html::radio("answers[$qNo]", false, ['value' =>$option-> option_text]) ?>
                        <?= $option->option_text ?>
                    </label>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endforeach; ?>
<?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>
