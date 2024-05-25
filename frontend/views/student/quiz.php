<?php
use backend\models\Options;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Questions;
/** @var yii\web\View  $this  */
$request = Yii::$app->request;
$questionid= $request->get('qid');
$assid=$request->get('assignmentid');
$questions = Questions::find()->where(['QuestionSet' => $questionid])->all();
$this->title = 'Form based Quiz';

?>
<!DOCTYPE html>
<style>
    p{margin: 0%}body{height: 100vh;background-color: whitesmoke;padding: 10px}
    label.box{display: flex;margin-top: 10px;padding: 10px 12px;border-radius: 5px;cursor: pointer;border: 1px solid #ddd}
    input[type="radio"]:checked + label.box .circle {
    border: 6px solid #8e498e;
    background-color: #fff;
    }
    label.box:hover{background: #d5bbf7}
    label.box .course{display: flex;align-items: center;width: 100%}
    label.box .circle{height: 22px;width: 22px;border-radius: 50%;margin-right: 15px;border: 2px solid #ddd;display: inline-block}input[type="radio"]{display: none}
    .btn.btn-primary{border-radius: 25px;margin-top: 20px}@media(max-width: 450px){.subject{font-size: 12px}}
    </style>
<?php $form = ActiveForm::begin(['action' => ['student/submit'], 'method' => 'post']); ?>
<?php foreach ($questions as $question): 
    $options = Options::find()->where(['questionNo' => $question->QuestionNo])->all();
?>
<div class="container mb-5"> <!-- Container added -->
    <div class="row"> 
        <div class="col-12"> 
            <p class="fw-bold"><?= $question->QuestionStatement ?></p> 
            <div>
            <?php foreach ($options as $key => $option): ?>
                <?php
                $qNo = $option->questionNo;
                $answers = Options::find()
                    ->where(['option_type' => 'correct'])
                    ->andWhere(['questionNo' => $qNo])
                    ->all();
                foreach ($answers as $answer):
                    $correctOption = $answer->option_text;
                ?>
                <?= Html::hiddenInput("correctAnswers[$qNo]", $correctOption) ?>
                <?= Html::hiddenInput("assignmentid", $assid)?>
                <?php endforeach; ?>
                <div> 
                    <?= Html::radio("answers[$qNo]", false, ['value' => $option->option_text, 'id' => "answer_{$qNo}_{$key}", 'name'=>"box[$qNo]"]) ?>
                    <label for="answer_<?= $qNo ?>_<?= $key ?>" class="box">
                        <div class="course"> 
                            <span class="circle"></span> 
                            <span class="subject"><?= $option->option_text ?></span>
                  </div>
                    </label>
                </div> 
            <?php endforeach; ?>
            </div>  
        </div>
    </div>
</div>
<?php endforeach; ?>
 <div class="col-12"> 
    <div class="d-flex justify-content-center"> 
    <button class="btn btn-primary px-4 py-2 fw-bold"> Submit</button> 
    </div> 
</div> 
<!-- Add this script at the end of your HTML file, just before the closing body tag -->
<!-- Add this script at the end of your HTML file, just before the closing body tag -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get the submit button
        var submitButton = document.querySelector('.btn-primary');
        
        // Initially disable the submit button
        submitButton.disabled = true;
        
        // Get all radio buttons
        var radioButtons = document.querySelectorAll('input[type="radio"]');
        
        // Add event listener to each radio button
        radioButtons.forEach(function(radioButton) {
            radioButton.addEventListener('change', function() {
                // Check if all radio button groups have at least one radio button checked
                var allChecked = true;
                var questionGroups = document.querySelectorAll('.row');
                
                questionGroups.forEach(function(group) {
                    var radiosInGroup = group.querySelectorAll('input[type="radio"]');
                    var anyChecked = Array.from(radiosInGroup).some(function(radio) {
                        return radio.checked;
                    });
                    if (!anyChecked) {
                        allChecked = false;
                    }
                });
                
                // Enable/disable submit button based on whether all radio buttons are checked
                submitButton.disabled = !allChecked;
            });
        });
    });
</script>

<?php ActiveForm::end(); ?>
</body>
</html>