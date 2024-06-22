<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
$this->title = 'Form based Game';
?>
<!DOCTYPE html>
<head>
<style>
        p {
            margin: 0%
        }

        body {
            height: 100vh;
            background-color: whitesmoke;
            padding: 10px
        }

        label.box {
            display: flex;
            margin-top: 10px;
            padding: 10px 12px;
            border-radius: 5px;
            cursor: pointer;
            border: 1px solid #ddd
        }

        input[type="radio"]:checked + label.box .circle {
            border: 6px solid #8e498e;
            background-color: #fff;
        }

        label.box:hover {
            background: #d5bbf7
        }

        label.box .course {
            display: flex;
            align-items: center;
            width: 100%
        }

        label.box .circle {
            height: 22px;
            width: 22px;
            border-radius: 50%;
            margin-right: 15px;
            border: 2px solid #ddd;
            display: inline-block
        }

        input[type="radio"] {
            display: none
        }

        .btn.btn-primary {
            border-radius: 25px;
            margin-top: 20px
        }

        @media(max-width: 450px) {
            .subject {
                font-size: 12px
            }
        }
    </style>
</head>
<body>
<?php ActiveForm::begin(['action' => ['student/submit'], 'method' => 'post']); ?>
    <div class="container mb-5"> <!-- Container added -->
        <div class="row">
            <div class="col-12">
                <?php $serializedArray = json_encode($correctOptions); ?>
                <?= Html::hiddenInput('correctAnswers', $serializedArray) ?>
                <?= Html::hiddenInput("assignmentid", $assid)?>
                <?php foreach ($questionsWithOptions as $questionNo => $questionWithOptions): ?>
                    <?php $question = $questionWithOptions['question']; ?>
                    <?php $options = $questionWithOptions['options']; ?>
                    <?php $qNo=$question->QuestionNo; ?>
                    <p class="fw-bold"><?= $question->QuestionStatement; ?></p>
                    <div>
                        <?php foreach ($options as $key => $option): ?>
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
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="d-flex justify-content-center">
            <button class="btn btn-primary px-4 py-2 fw-bold">Submit</button>
        </div>
    </div>
<?php ActiveForm::end(); ?>
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
            // Check if one radio button is checked in each group
            var allGroupsChecked = true;
            var groupName;
            var groups = {};

            // Loop through all radio buttons and group them by name
            radioButtons.forEach(function(radioButton) {
                groupName = radioButton.getAttribute('name');
                if (!groups[groupName]) {
                    groups[groupName] = [];
                }
                groups[groupName].push(radioButton);
            });

            // Check if at least one radio button is checked in each group
            for (var groupName in groups) {
                var anyChecked = false;
                groups[groupName].forEach(function(radio) {
                    if (radio.checked) {
                        anyChecked = true;
                    }
                });
                if (!anyChecked) {
                    allGroupsChecked = false;
                }
            }

            // Enable/disable submit button based on whether one radio button is checked in each group
            submitButton.disabled = !allGroupsChecked;
        });
    });
});
</script>
</body>
</html>