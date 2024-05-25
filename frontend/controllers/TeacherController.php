<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\TeacherApprovalRequests;
use common\models\User;

class TeacherController extends Controller
{
    public function actionIndex()
    {   
        $userId = Yii::$app->user->id;
        $user = User::findOne($userId);

        if ($user !== null && $user->user_type === 'teacher') {
            $teacherApprovalRequest = TeacherApprovalRequests::find()->where(['teacher_id' => $userId])->one();
            if ($teacherApprovalRequest !== null) {
                return $this->render('index');
            }
        }

        return $this->redirect(['guest/courses']);
    }
}
