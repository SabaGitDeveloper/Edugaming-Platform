<?php

namespace frontend\controllers;

use yii\web\Controller;
use backend\models\Options;
use backend\models\StudentJoinRequests;
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
    public function actionRequest()
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
}
