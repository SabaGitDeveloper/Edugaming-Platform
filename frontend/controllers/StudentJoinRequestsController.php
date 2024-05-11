<?php

namespace frontend\controllers;

use Yii;
use backend\models\StudentJoinRequests;
use backend\models\CourseStudent;
use yii\web\Controller;
use yii\data\ActiveDataProvider;

class StudentJoinRequestsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $teacherId = Yii::$app->user->identity->id;
        
        $dataProvider = new ActiveDataProvider([
            'query' => StudentJoinRequests::find()->where(['teacher_id' => $teacherId]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionApprove($id)
    {
        $model = $this->findModel($id);
        $model->status = 'Approved'; 

        if ($model->save()) {
            $courseStudent = new CourseStudent();
            $courseStudent->CourseID = $model->course_id;
            $courseStudent->Student_ID = $model->student_id;

            if ($courseStudent->save()) {
                Yii::$app->session->setFlash('success', 'Request approved successfully and student enrolled in the course.');
            } else {
                Yii::$app->session->setFlash('error', 'Failed to enroll student in the course.');
            }
        } else {
            Yii::$app->session->setFlash('error', 'Failed to approve request.');
        }

        return $this->redirect(['index']);
    }

    public function actionReject($id)
    {
        $model = $this->findModel($id);
        $model->status = 'Rejected'; 
        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'Request rejected successfully.');
        } else {
            Yii::$app->session->setFlash('error', 'Failed to reject request.');
        }
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = StudentJoinRequests::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
