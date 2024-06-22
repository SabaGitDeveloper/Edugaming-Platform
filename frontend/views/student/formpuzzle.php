
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
$this->title = 'Puzzle Form based Game';
?>
<!DOCTYPE html>
<body>
<?php $form = ActiveForm::begin(['action' => ['student/puzzlesubmit'], 'method' => 'post']);
$serializedArray = json_encode($shuffledSequence); ?>
<?= Html::hiddenInput("assignmentid", $assid) ?>
<?= Html::hiddenInput("shuffledSequence", $serializedArray) ?>
<?php foreach ($questionsWithOptions as $questionNo => $questionWithOptions): ?>
    <?php $question = $questionWithOptions['question']; ?>
    <?php $options = $questionWithOptions['options'];
    $sequenceNumbers=[];
    $index=0;
    foreach ($options as $option) {
        $sequenceNumbers[$option->sequence_number] =$option->sequence_number;
     }?>
<div class="container mb-5">
    <div class="row">
        <div class="col-12">
            <p class="fw-bold"><?= $question->QuestionStatement ?></p>
            <div>
                <?php foreach ($options as  $option):?>
                    <div> 
                        <div class="course"> 
                            <span class="subject"><?= $option->option_text ?></span>
                        </div>
                        <?= Html::dropDownList("answers[$question->QuestionNo][$option->optionID]",null,$sequenceNumbers,['prompt'=>'Select an Option']) ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
<div class="col-12"> 
    <div class="d-flex justify-content-center"> 
        <button class="btn btn-primary px-4 py-2 fw-bold">Submit</button> 
    </div> 
</div> 
<?php ActiveForm::end(); ?>
</body>
</html>