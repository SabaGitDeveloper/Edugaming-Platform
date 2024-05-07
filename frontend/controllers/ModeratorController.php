<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Questions;
use backend\models\QuestionSet;
use backend\models\TeacherApprovalRequests;
use backend\models\CourseTeacher;

class ModeratorController extends Controller
{
    public function actionSubmit2()
    {
        if (Yii::$app->request->isPost) {
            $postData = Yii::$app->request->post();

            // Handle action (accept or reject)
            $action = $postData['action']; 
            $tarId = $postData['idTeacher_Approval_Requests'];
           // echo "<script>alert('.$tarId.');</script>"; 
            $tar = TeacherApprovalRequests::findOne($tarId);
 
            if ($action === 'accept') {
                $tar->status = 'approved';
             //   echo "<script>alert('.$tar->status.');</script>";
                $tar->Moderator_id=Yii::$app->session->get('user_id');
                echo $tar->status;
                $tar->save();
                if ($tar->save()) {
                    Yii::$app->session->setFlash('success', 'Data saved successfully.');
                } else {
                    Yii::$app->session->setFlash('error', 'Error occurred while saving data.');
                }
                // If the request is accepted, add the teacher_id and course_id to CourseTeacher table
                if ($tar->status === 'approved') {
                    $coursesteacher = new CourseTeacher();
                    $coursesteacher->Teacher_id = $tar->teacher_id;
                    $coursesteacher->Course_id = $tar->course_id;
                    $coursesteacher->save();
                }
    

            } elseif ($action === 'reject') {
                $tar->status = 'rejected';
                $tar->Moderator_id=Yii::$app->session->get('user_id');
                $tar->save();
                if ($tar->save()) {
                    Yii::$app->session->setFlash('success', 'Data saved successfully.');
                } else {
                    Yii::$app->session->setFlash('error', 'Error occurred while saving data.');
                }
            }

            return $this->render('/site/mdashboard');
        }
    }

    public function actionCourses()
    {
        return $this->render('/moderator/courses.php');
    }
    public function actionApprovals()
    {
        return $this->render('/moderator/approvals.php');
    }
    public function actionTopic()
    {
        return $this->render('/moderator/topic.php');
    }
    public function actionQuestionset()
    {
        return $this->render('/moderator/questionset.php');
    }
    public function actionQuestions()
    {
        return $this->render('/moderator/questions.php');
    }
    public function actionSubmit()
    {
        if (Yii::$app->request->isPost) {
            $postData = Yii::$app->request->post();
    
            // Handle comments for each question
            foreach ($postData['Questions'] as $questionId => $questionData) {
                $question = Questions::findOne($questionId);
                $question->comments = $questionData['comments'];
                $question->save();
            }
    
            // Handle action (accept or reject)
            $action = $postData['action']; 
            $questionSetId = $postData['questionSetId']; 
            $questionSet = QuestionSet::findOne($questionSetId);
    
            if ($action === 'accept') {
                $questionSet->status = 'approved';
            } elseif ($action === 'reject') {
                $questionSet->status = 'rejected';
            }
    
            $questionSet->save();
            return $this->render('/site/mdashboard');
        }
    }
    public function actionRequests()
    {
        return $this->render('/moderator/request.php');
    }

    public function actionNotifications()
    {
        return $this->render('notifications');
    }

    public function actionNewrequest()
    {//copied from actionCreate() of moderapprovalrequestscontroller
        //one idea is to copy the _form.php and create.php files in here to carryout the process or access the backend folder
        //same code will get copied for studentrequest and maybe delete sendrequest.php from both
        $model = new ModeratorApprovalRequests();
        $model->status='pending';
        $model->date_sent=date('Y-m-d H:i:s');
        $model->course_id=\Yii::$app->request->get('course_id');
        $model->moderator_id=\Yii::$app->request->get('admin_id');

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'idModerator_Approval_Requests' => $model->idModerator_Approval_Requests]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
        //return $this->render('/moderator/newrequest.php');
    }
}
