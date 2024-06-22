<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Options;
use backend\models\StudentJoinRequests;
use backend\models\Studentgameassignment;
use backend\models\Courses;
use backend\models\CourseTeacher;
use backend\models\Teacher;
use common\models\User;

use backend\models\OptionsPuzzle;
use backend\models\Questions;
use backend\models\CourseStudent;
use backend\models\Topic;
use backend\models\GameAssignments;


class StudentController extends Controller
{
 

    public function actionCourses()
    {
        $userId = \Yii::$app->session->get('user_id');
        $StudentCourses = CourseStudent::find()->where(['Student_ID' => $userId])->all();
        foreach ($StudentCourses as $stc){
            $coursecode=$stc->CourseID;
            $courses = Courses::find()->where(['course_code' => $coursecode])->all();
        }
        return $this->render( '/student/courses',
            [
                'courses'=>$courses
            ]);
    }
    public function actionTopic()
    {
         // Get the request object
         $request = \Yii::$app->request;
         $courseid= $request->get('id');
         $topics = Topic::find()->where(['course_code' => $courseid])->all();
         return $this->render('/student/topic.php',[
             'topics'=>$topics,
             'courseid'=>$courseid
         ]);
    }
    public function actionAssignment()
    {
        // Get the request object
        $request = \Yii::$app->request;
        $topicid= $request->get('id');
        $courseid= $request->get('courseid');
        $assignments = GameAssignments::find()->where(['topicID' => $topicid])->all();
        foreach ($assignments as $assignment){
        $AssignmentScore= Studentgameassignment::find()->where(['AssignmentId' => $assignment->assignmentID])->one();
        $assignmentScores[$assignment->assignmentID] = $AssignmentScore;
        }
        return $this->render('/student/assignment.php',[
            'assignments'=>$assignments,
            'courseid'=>$courseid,
            'assignmentScores'=>$assignmentScores

        ]);
    }
    public function actionQuiz()
    {
        return $this->render('/student/quiz.php');
    }
    public function actionSubmit()
    {
        // $submittedAnswers = \Yii::$app->request->post('answers');
        // $correctAnswers = \Yii::$app->request->post('correctAnswers');
        // $assignmentid = \Yii::$app->request->post('assignmentid');
        // $clicks=\Yii::$app->request->post('clicks');
        // $score = 0;
        // $totalQuestions = 0;
        // foreach ($submittedAnswers as $questionNo => $submittedAnswer) {
        //     $totalQuestions++;
        //     if ($submittedAnswer == $correctAnswers[$questionNo]) {
        //         $score++;
        //     }
        // }
        // $model = StudentGameAssignment::find()->where(['AssignmentId' => $assignmentid])->one();
        // // Check if the model is null
        // if ($model === null) {
        //     // Log or display an error message
        //     \Yii::error('Unable to find Studentgameassignment model with assignment ID: ' . $assignmentid);
        // }
        // else{
        // $clicks=$model->tries;
        // $model->Accuracy = $score / $totalQuestions * 100;
        // $model->Speed = 0;
        // $model->tries = ++$clicks;
        // $model->save();
        // }
        // return $this->render('/student/result.php', ['aid' => $assignmentid]);
        $submittedAnswers = \Yii::$app->request->post('answers');
        $correctAnswers = \Yii::$app->request->post('correctAnswers');
        $serializedArray = json_decode($correctAnswers,true);
        $assignmentid = \Yii::$app->request->post('assignmentid');
        $assignments = GameAssignments::find()->where(['assignmentID' => $assignmentid])->all();
        foreach($assignments as $assignment){
            $mode=$assignment->game_mode;
            $courseid=$assignment->course_code;
            $topicid=$assignment->topicId;
            $questionset=$assignment->question_setID;
            $interface=$assignment->interface_type;
        }
        $score = 0;
        $totalQuestions = 0;
        foreach ($submittedAnswers as $questionNo => $submittedAnswer) {
            $totalQuestions++;
            if ($submittedAnswer == $serializedArray[$questionNo]) {
                $score++;
            }
        }
        $model = Studentgameassignment::find()->where(['AssignmentId' => $assignmentid])->one();
        // Check if the model is null
        if ($model === null) {
            // Log or display an error message
            \Yii::error('Unable to find Studentgameassignment model with assignment ID: ' . $assignmentid);
        }
        else{
        $clicks=$model->tries;
        $model->Accuracy = round($score / $totalQuestions * 100);
        $model->Speed = 0;
        $model->tries = ++$clicks;
        $model->save();
        }
        return $this->render('/student/result.php', [
        'accuracy' => $model->Accuracy,
        'speed'=> $model->Speed,
        'tries'=>$model->tries,
        'mode'=>$mode,
        'courseid'=>$courseid,
        'totalQuestions'=>$totalQuestions,
        'topicid'=>$topicid,
        'assignmentid'=>$assignmentid,
        'questionset'=>$questionset,
        'interface'=>$interface
        ]);
    }
    public function actionRequest()
    {
        $userId = \Yii::$app->session->get('user_id');
        $StudentRequests = StudentJoinRequests::find()->where(['student_id' => $userId])->all();
        $teachers=[];
        foreach ($StudentRequests as $sr){
            $status=$sr->status;
            if($status=="pending"){
                $teacherId=$sr->teacher_id;
                $teacher = User::find()->where(['id' => $teacherId])->one();
                if ($teacher) {
                    $teacherData[] = [
                        'teacher' => $teacher,
                        'course_id' => $sr->course_id,
                    ];
                }
               // $teachers []= User::find()->where(['id' => $teacherId])->one();
            }
        }
        return $this->render('/student/request.php',[
            'teacherData' => $teacherData,
        ]);
    }
    public function actionPuzzle()
    {
        return $this->render('/student/puzzle.php');
    }
    public function actionNotifications()
    {
        return $this->render('notifications');
    }

    public function actionAssgall()
    {
        $userId = \Yii::$app->session->get('user_id');
        $StudentCourses = CourseStudent::find()->where(['Student_ID' => $userId])->all();
        foreach ($StudentCourses as $stc){
            $coursecode=$stc->CourseID;
            $courses = Courses::find()->where(['course_code' => $coursecode])->all();
        }
        foreach($courses as $course){
            $courseid=$course->course_code;
            $assignments = GameAssignments::find()->where(['course_code' => $courseid])->all();
            foreach ($assignments as $assignment){
            $AssignmentScore= Studentgameassignment::find()->where(['AssignmentId' => $assignment->assignmentID])->one();
            $assignmentScores[$assignment->assignmentID] = $AssignmentScore;
            }
        }
        return $this->render('/student/assignment.php',[
            'assignments'=>$assignments,
            'courseid'=>$courseid,
            'assignmentScores'=>$assignmentScores

        ]);
    }
    public function actionProgress()
    {
        $userId = \Yii::$app->session->get('user_id');
        $StudentCourses = CourseStudent::find()->where(['Student_ID' => $userId])->all();
        $courseProgress = [];
        foreach ($StudentCourses as $stc) {
            $coursecode = $stc->CourseID;
            $assignments = GameAssignments::find()->where(['course_code' => $coursecode])->all();
            $AssignmentScores = Studentgameassignment::find()->where(['CourseID' => $coursecode])->all();
            $total = count($assignments);
            $pending = 0;
            $completed = 0;
            $expired = 0;
            foreach ($assignments as $assignment) {
                $expiryDate = strtotime($assignment->due_date);
                $currentDate = time();
                $isAssignmentCompleted = false;
    
                foreach ($AssignmentScores as $AssignmentScore) {
                    if ($AssignmentScore->AssignmentId == $assignment->assignmentID) {
                        if ($AssignmentScore->tries > 0) {
                            $completed++;
                            $isAssignmentCompleted = true;
                            break; // No need to check further if assignment is completed
                        }
                    }
                }
    
                // If assignment is not completed, check if it's pending or expired
                if (!$isAssignmentCompleted) {
                    if ($currentDate < $expiryDate) {
                        $pending++;
                    } else {
                        $expired++;
                    }
                }
            }
            $courseProgress[$coursecode] = [
                'assignments' => $assignments,
                'AssignmentScores' => $AssignmentScores,
                'total' => $total,
                'pending' => $pending,
                'completed' => $completed,
                'expired' => $expired,
                'coursecode' => $coursecode
            ];
        }
    
        return $this->render('/student/progress.php', [
            'courseProgress' => $courseProgress,
        ]);
    }
    public function actionNewrequest()
    {
        return $this->render('/student/newrequest.php');
    }
    public function actionCreaterequest()
    {
        $model = new StudentJoinRequests();
        $model->status='pending';
        $model->date_sent=date('Y-m-d H:i:s');
        $model->course_id=\Yii::$app->request->get('cid');
        $model->student_id=\Yii::$app->session->get('user_id');
        $model->teacher_id=10;

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['student/request', 'idStudent_join_Requests' => $model->idStudent_join_Requests]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('createrequest', [
            'model' => $model,
        ]);
       // return $this->render('/moderator/createrequest.php');
    }
    public function actionResult()
    {
        $request = \Yii::$app->request;
        $questionset= $request->get('qid');
        $interface=$request->get('inid');
        $assignmentid=$request->get('assid');
        $gameassignment = GameAssignments::find()->where(['assignmentID' => $assignmentid])->one();
        $courseid=$gameassignment->course_code;
        $topicid=$gameassignment->topicId;
        $mode=$gameassignment->game_mode;
        $AssignmentScore= Studentgameassignment::find()->where(['AssignmentId' => $assignmentid])->one();
        $totalQuestions = Questions::find()->where(['QuestionSet' => $questionset])->count();
            $speed=$AssignmentScore->Speed;
            $accuracy=$AssignmentScore->Accuracy;
            $tries=$AssignmentScore->tries;

        return $this->render('/student/result.php',[
            'accuracy'=>$accuracy,
            'speed'=>$speed,
            'tries'=>$tries,
            'mode'=>$mode,
            'courseid'=>$courseid,
            'totalQuestions'=>$totalQuestions,
            'topicid'=>$topicid,
            'assignmentid'=>$assignmentid,
            'questionset'=>$questionset,
            'interface'=>$interface
        ]); 
    }
    // public function actionCourseTeachers($course_code)
    // {
    //     $course = Courses::findOne($course_code);

    //     $teachers = CourseTeacher::find()
    //         ->where(['Course_id' => $course_code])
    //         ->with('teacher') 
    //         ->all();
        
    //     $teacherDetails = [];
        
    //     foreach ($teachers as $teacher) 
    //     {
    //         $teacherName = User::findOne($teacher->Teacher_id)->username;
    //         $details = Teacher::findOne($teacher->Teacher_id);
    //         $teacherDetails[] = [
    //             'id' => $details->memberID, 
    //             'name' => $teacherName,
    //             'qualification' => $details->qualification,
    //             'experience' => $details->experience,
    //             'speciality' => $details->speciality,
    //         ];
    //     }
        
    //     return $this->render('course-teachers', [
    //         'course' => $course,
    //         'teacherDetails' => $teacherDetails,
    //     ]);
    // }
    public function actionFormbasedgame()
    {
        $request = \Yii::$app->request;
        $questionid= $request->get('qid');
        $inid=$request->get('inid');
        $assid=$request->get('assignmentid');
        $questionsWithOptions = [];
        if($inid=="BubblePop"){
        $questions = Questions::find()->where(['QuestionSet' => $questionid])->all();
        // Initialize an array to hold options for each question

        // Loop through each question
        foreach ($questions as $question) {
            // Retrieve options for the current question
            $options = Options::find()->where(['questionNo' => $question->QuestionNo])->all();
            
            // Assign options to the current question
            $questionsWithOptions[$question->QuestionNo] = [
                'question' => $question,
                'options' => $options,
            ];
        }
        $correctOptions = [];
        foreach ($questions as $question) {
        $answers=  Options::find()->where(['option_type'=>'correct','questionNo' => $question->QuestionNo])->all();
        foreach ($answers as $answer) {
            $correctOptions[$answer->questionNo] = $answer->option_text;
        }
        }
        return $this->render('/student/formbasedgame.php', [
            'questionsWithOptions' => $questionsWithOptions,
            'inid' => $inid,
            'assid' => $assid,
            'correctOptions' => $correctOptions,
            // Pass other necessary data to the view
        ]);
        }
        if($inid=="BubblePop with Multiple Options"){
        $questions = Questions::find()->where(['QuestionSet' => $questionid])->all();
        // Initialize an array to hold options for each question

        // Loop through each question
        foreach ($questions as $question) {
            // Retrieve options for the current question
            $options = Options::find()->where(['questionNo' => $question->QuestionNo])->all();
            
            // Assign options to the current question
            $questionsWithOptions[$question->QuestionNo] = [
                'question' => $question,
                'options' => $options,
            ];
        }
        $correctOptions[$question->QuestionNo] = [];
        foreach ($questions as $question) {
        $answers=  Options::find()->where(['option_type'=>'correct','questionNo' => $question->QuestionNo])->all();
        foreach ($answers as $answer) {
            $correctOptions[$question->QuestionNo][] = $answer->option_text;
        }
        }
        // print_r($correctOptions);
        return $this->render('/student/formbasedmultichoice.php', [
            'questionsWithOptions' => $questionsWithOptions,
            'inid' => $inid,
            'assid' => $assid,
            'correctOptions' => $correctOptions,
            // Pass other necessary data to the view
        ]);
        }
        else if($inid == 'Assembling') {
        $questions = QuestionsPuzzle::find()->where(['QuestionSet' => $questionid])->all();
        $questionsWithOptions = [];
        $correctSequence = [];
        $shuffledSequence = [];
        foreach ($questions as $question) {
            $options = OptionsPuzzle::find()->where(['questionNo' => $question->QuestionNo])->all();
            foreach ($options as $option) {
                $correctSequence[$question->QuestionNo][$option->optionID] = $option->sequence_number;
            }
            shuffle($options);
            foreach ($options as $option) {
                $shuffledSequence[$question->QuestionNo][$option->optionID] = $option->sequence_number;
            }
            while ($correctSequence === $shuffledSequence) {
                shuffle($options);
                $shuffledSequence = [];
                foreach ($options as $option) {
                    $shuffledSequence[$question->QuestionNo][$option->optionID] = $option->sequence_number;
                }
            }
            $questionsWithOptions[$question->QuestionNo] = [
                'question' => $question,
                'options' => $options,
            ];
        }
    
        return $this->render('/student/formpuzzle.php', [
            'questionsWithOptions' => $questionsWithOptions,
            'inid' => $inid,
            'assid' => $assid,
            'shuffledSequence' => $shuffledSequence,
        ]);
        }
    
    }
    public function actionSubmitmulti()
    {
        $submittedAnswers = \Yii::$app->request->post('answers');
        $correctAnswers = \Yii::$app->request->post('correctAnswers');
        $serializedArray = json_decode($correctAnswers,true);
        $assignmentid = \Yii::$app->request->post('assignmentid');
        $assignments = GameAssignments::find()->where(['assignmentID' => $assignmentid])->all();
        foreach($assignments as $assignment){
            $mode=$assignment->game_mode;
            $courseid=$assignment->course_code;
            $topicid=$assignment->topicId;
            $questionset=$assignment->question_setID;
            $interface=$assignment->interface_type;
        }
        $score = 0;
        $totalQuestions = 0;
        foreach ($submittedAnswers as $questionNo => $selectedOptions) {
            $totalQuestions++;
            if (isset($serializedArray[$questionNo])) {
                $correctOptions = $serializedArray[$questionNo];
                $flag=true;
                foreach($selectedOptions as $selectedOption){
                    if (!in_array($selectedOption, $correctOptions)) {
                        $flag=false;
                    }
                }
                if($flag){
                $score ++;
                }

            }
        }
        $model = Studentgameassignment::find()->where(['AssignmentId' => $assignmentid])->one();
        if ($model === null) {
            \Yii::error('Unable to find Studentgameassignment model with assignment ID: ' . $assignmentid);
        }
        else{
            $clicks=$model->tries;
            $model->Accuracy = round($score / $totalQuestions * 100);
            $model->Speed = 0;
            $model->tries = ++$clicks;
            $model->save();
        }
        return $this->render('/student/result.php', [
        'accuracy' => $model->Accuracy,
        'speed'=> $model->Speed,
        'tries'=>$model->tries,
        'mode'=>$mode,
        'courseid'=>$courseid,
        'totalQuestions'=>$totalQuestions,
        'topicid'=>$topicid,
        'assignmentid'=>$assignmentid,
        'questionset'=>$questionset,
        'interface'=>$interface
        ]);
    }
    public function actionPuzzlesubmit()
    {
        $submittedAnswers = \Yii::$app->request->post('answers');
        $correctSequence = \Yii::$app->request->post('shuffledSequence');
        $serializedArray = json_decode($correctSequence,true);
        $assignmentid = \Yii::$app->request->post('assignmentid'); 
        $assignments = GameAssignments::find()->where(['assignmentID' => $assignmentid])->all();
        foreach($assignments as $assignment){
            $mode=$assignment->game_mode;
            $courseid=$assignment->course_code;
            $topicid=$assignment->topicId;
            $questionset=$assignment->question_setID;
            $interface=$assignment->interface_type;
        }
        // print_r($submittedAnswers);
        // print_r($serializedArray);
        $score = 0;
        $totalQuestions = 0;
        foreach ($submittedAnswers as $questionNo=>$submittedAnswer) {
            $totalQuestions++;
            $submittedAnswer=implode($submittedAnswer);
            $serializedsequence=implode($serializedArray[$questionNo]);
            // print_r($submittedAnswer.'.....');
            // print_r($serializedsequence.'.......');
            if ($submittedAnswer == $serializedsequence) {
                $score++;
            }
        }
        $model = Studentgameassignment::find()->where(['AssignmentId' => $assignmentid])->one();
        // Check if the model is null
        if ($model === null) {
            // Log or display an error message
            \Yii::error('Unable to find Studentgameassignment model with assignment ID: ' . $assignmentid);
        }
        else{
        $clicks=$model->tries;
        $model->Accuracy = round($score / $totalQuestions * 100);
        $model->Speed = 0;
        $model->tries = ++$clicks;
        $model->save();
        }
        return $this->render('/student/result.php', 
        ['accuracy' => $model->Accuracy,
        'speed'=> $model->Speed,
        'tries'=>$model->tries,
        'mode'=>$mode,
        'courseid'=>$courseid,
        'totalQuestions'=>$totalQuestions,
        'topicid'=>$topicid,
        'assignmentid'=>$assignmentid,
        'questionset'=>$questionset,
        'interface'=>$interface
        ]);
    }
}
