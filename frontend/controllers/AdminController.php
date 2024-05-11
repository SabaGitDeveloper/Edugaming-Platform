<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\ModeratorApprovalRequests;
use backend\models\CoursesModerated;
use backend\models\Courses;

class AdminController extends Controller
{
 
    public function actionSubmit()
    {
        if (Yii::$app->request->isPost) {
            $postData = Yii::$app->request->post();
    
            // Handle action (accept or reject)
            $action = $postData['action']; 
            $marId = $postData['idModerator_Approval_Requests']; 
            $mar = ModeratorApprovalRequests::findOne($marId);
    
            if ($action === 'accept') {
                $mar->status = 'approved';
                $mar->save();

                // If the request is accepted, add the moderator_id and course_id to CoursesModerated table
                if ($mar->status === 'approved') {
                    $coursesModerated = new CoursesModerated();
                    $coursesModerated->moderator_id = $mar->moderator_id;
                    $coursesModerated->course_id = $mar->course_id;
                    $coursesModerated->save();
                }
    

            } elseif ($action === 'reject') {
                $mar->status = 'rejected';
                $mar->save();
            }
          
            return $this->render('/site/adashboard');
        }
    }
    public function actionCourses()
    {
        return $this->render('/admin/courses.php');
    }
    public function actionTopic()
    {
        return $this->render('/admin/topic.php');
    }
    
    public function actionRequests()
    {
        return $this->render('/admin/request.php');
    }

    public function actionNotifications()
    {
        return $this->render('notifications');
    }

}
