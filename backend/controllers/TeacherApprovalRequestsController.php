<?php

namespace backend\controllers;

use Yii;
use backend\models\TeacherApprovalRequests;
use backend\models\TeacherApprovalRequestsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TeacherApprovalRequestsController implements the CRUD actions for TeacherApprovalRequests model.
 */
class TeacherApprovalRequestsController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all TeacherApprovalRequests models.
     *
     * @return string
     */
    public function actionIndex()
    {
        // Only a moderator or teacher can view a student request
		if (Yii::$app->user->isGuest) {
			Yii::$app->session->setFlash('error', 'Access allowed after login.');
            return $this->goHome();
        }
		
		if(!isset($_SESSION['user_id'])){
				Yii::$app->session->setFlash('error', 'Session Expired. Please login again.');
				Yii::$app->user->logout();
				return $this->goHome();
		}
		
		if(!isset($_SESSION['user_is'])){
				Yii::$app->session->setFlash('error', 'Access allowed to moderators and teachers only.');
				return $this->goHome();
		}
		
		if($_SESSION['user_is'] != 'moderator'&&$_SESSION['user_is'] != 'teacher'){
				Yii::$app->session->setFlash('error', 'Access allowed to moderators and teachers only.');
				return $this->goHome();
		}
        //-------------------------------------------
        $courseid = Yii::$app->request->get('course_id');
        $userid = Yii::$app->session->get('user_id');
        $useris = Yii::$app->session->get('user_is');
        if($courseid!==null){
            Yii::$app->session->set('course_code',$courseid);
        }
        $searchModel = new TeacherApprovalRequestsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        if ($courseid !== null) {
            if($useris=='teacher')
            $dataProvider->query->andFilterWhere(['course_id' => $courseid,'teacher_id'=>$userid]);
            else
            $dataProvider->query->andFilterWhere(['course_id' => $courseid,'Moderator_id'=>$userid]);
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TeacherApprovalRequests model.
     * @param int $idTeacher_Approval_Requests Id Teacher Approval Requests
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idTeacher_Approval_Requests)
    {
        return $this->render('view', [
            'model' => $this->findModel($idTeacher_Approval_Requests),
        ]);
    }

    /**
     * Creates a new TeacherApprovalRequests model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        
        // Only a teacher can create a teacher request
		if (Yii::$app->user->isGuest) {
			Yii::$app->session->setFlash('error', 'Access allowed after login.');
            return $this->goHome();
        }
		
		if(!isset($_SESSION['user_id'])){
				Yii::$app->session->setFlash('error', 'Session Expired. Please login again.');
				Yii::$app->user->logout();
				return $this->goHome();
		}
		
		if(!isset($_SESSION['user_is'])){
				Yii::$app->session->setFlash('error', 'Access allowed to teachers only.');
				return $this->goHome();
		}
		
		if($_SESSION['user_is'] != 'teacher'){
				Yii::$app->session->setFlash('error', 'Access allowed to teachers only.');
				return $this->goHome();
		}
        //-------------------------------------------
        $model = new TeacherApprovalRequests();
        $model->status='pending';
        $model->date_sent=date('Y-m-d H:i:s');
        $model->course_id=\Yii::$app->request->get('course_id');
        $model->Moderator_id=\Yii::$app->request->get('moderator_id') ;

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'idTeacher_Approval_Requests' => $model->idTeacher_Approval_Requests]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TeacherApprovalRequests model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $idTeacher_Approval_Requests Id Teacher Approval Requests
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idTeacher_Approval_Requests)
    {
        // Only a moderator can update status of a teacher request
		if (Yii::$app->user->isGuest) {
			Yii::$app->session->setFlash('error', 'Access allowed after login.');
            return $this->goHome();
        }
		
		if(!isset($_SESSION['user_id'])){
				Yii::$app->session->setFlash('error', 'Session Expired. Please login again.');
				Yii::$app->user->logout();
				return $this->goHome();
		}
		
		if(!isset($_SESSION['user_is'])){
				Yii::$app->session->setFlash('error', 'Access allowed to moderators only.');
				return $this->goHome();
		}
		
		if($_SESSION['user_is'] != 'moderator'){
				Yii::$app->session->setFlash('error', 'Access allowed to moderators only.');
				return $this->goHome();
		}
        //-------------------------------------------
        $model = $this->findModel($idTeacher_Approval_Requests);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idTeacher_Approval_Requests' => $model->idTeacher_Approval_Requests]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TeacherApprovalRequests model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $idTeacher_Approval_Requests Id Teacher Approval Requests
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idTeacher_Approval_Requests)
    {
        //only moderator can delete teacher request
        if (Yii::$app->user->isGuest) {
			Yii::$app->session->setFlash('error', 'Access allowed after login.');
            return $this->goHome();
        }
		
		if(!isset($_SESSION['user_id'])){
				Yii::$app->session->setFlash('error', 'Session Expired. Please login again.');
				Yii::$app->user->logout();
				return $this->goHome();
		}
		
		if(!isset($_SESSION['user_is'])){
				Yii::$app->session->setFlash('error', 'Access allowed to moderators only.');
				return $this->goHome();
		}
		
		if($_SESSION['user_is'] != 'moderator'){
				Yii::$app->session->setFlash('error', 'Access allowed to moderators only.');
				return $this->goHome();
		}
        //-------------------------------------------
        $this->findModel($idTeacher_Approval_Requests)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TeacherApprovalRequests model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idTeacher_Approval_Requests Id Teacher Approval Requests
     * @return TeacherApprovalRequests the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idTeacher_Approval_Requests)
    {
        if (($model = TeacherApprovalRequests::findOne(['idTeacher_Approval_Requests' => $idTeacher_Approval_Requests])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
