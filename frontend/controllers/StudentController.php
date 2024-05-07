<?php

namespace frontend\controllers;

use yii\web\Controller;
use backend\models\Options;
class StudentController extends Controller
{
 

    public function actionCourses()
    {
        return $this->render('/student/courses.php');
    }
    public function actionTopic()
    {
        return $this->render('/student/topic.php');
    }
    public function actionAssignment()
    {
        return $this->render('/student/assignment.php');
    }
    public function actionQuiz()
    {
        return $this->render('/student/quiz.php');
    }
    public function actionSubmit()
    {
        $submittedAnswers = \Yii::$app->request->post('answers');
        $correctAnswers = \Yii::$app->request->post('correctAnswers');
        $score = 0;
        $totalQuestions = 0;
        foreach ($submittedAnswers as $questionNo => $submittedAnswer) {
            $totalQuestions++;
            if ($submittedAnswer == $correctAnswers[$questionNo]) {
                $score++;
            }
        }
        return $this->render('/student/result.php', ['score' => $score, 'totalQuestions' => $totalQuestions]);
    }
    public function actionRequests()
    {
        return $this->render('/student/request.php');
    }

    public function actionNotifications()
    {
        return $this->render('notifications');
    }

    public function actionAssgall()
    {
        return $this->render('/student/assgall.php');
    }
    public function actionNewrequest()
    {
        return $this->render('/student/newrequest.php');
    }
}
