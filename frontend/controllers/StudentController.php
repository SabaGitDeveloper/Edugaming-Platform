<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Options;
use backend\models\StudentJoinRequests;
use backend\models\StudentGameAssignment;
use backend\models\Courses;
use backend\models\CourseTeacher;
use backend\models\Teacher;
use common\models\User;


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
        $assignmentid = \Yii::$app->request->post('assignmentid');
        $clicks=\Yii::$app->request->post('clicks');
        $score = 0;
        $totalQuestions = 0;
        foreach ($submittedAnswers as $questionNo => $submittedAnswer) {
            $totalQuestions++;
            if ($submittedAnswer == $correctAnswers[$questionNo]) {
                $score++;
            }
        }
        $model = StudentGameAssignment::find()->where(['AssignmentId' => $assignmentid])->one();
        // Check if the model is null
        if ($model === null) {
            // Log or display an error message
            \Yii::error('Unable to find Studentgameassignment model with assignment ID: ' . $assignmentid);
        }
        else{
        $clicks=$model->tries;
        $model->Accuracy = $score / $totalQuestions * 100;
        $model->Speed = 0;
        $model->tries = ++$clicks;
        $model->save();
        }
        return $this->render('/student/result.php', ['aid' => $assignmentid]);
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
    public function actionProgress()
    {
        return $this->render('/student/progress.php');
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
        return $this->render('/student/result.php');
    }
    public function actionCourseTeachers($course_code)
    {
        $course = Courses::findOne($course_code);

        $teachers = CourseTeacher::find()
            ->where(['Course_id' => $course_code])
            ->with('teacher') 
            ->all();
        
        $teacherDetails = [];
        
        foreach ($teachers as $teacher) 
        {
            $teacherName = User::findOne($teacher->Teacher_id)->username;
            $details = Teacher::findOne($teacher->Teacher_id);
            $teacherDetails[] = [
                'id' => $details->memberID, 
                'name' => $teacherName,
                'qualification' => $details->qualification,
                'experience' => $details->experience,
                'speciality' => $details->speciality,
            ];
        }
        
        return $this->render('course-teachers', [
            'course' => $course,
            'teacherDetails' => $teacherDetails,
        ]);
    }
}
