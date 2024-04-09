<?php

namespace backend\controllers;

use Yii;
use backend\models\ModeratorApprovalRequests;
use backend\models\ModeratorApprovalRequestsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ModeratorApprovalRequestsController implements the CRUD actions for ModeratorApprovalRequests model.
 */
class ModeratorApprovalRequestsController extends Controller
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
     * Lists all ModeratorApprovalRequests models.
     *
     * @return string
     */
    public function actionIndex()
    {
        // Only a moderator or system admin can view a student request
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
				Yii::$app->session->setFlash('error', 'Access allowed to moderator and system admins only.');
				return $this->goHome();
		}
		
		if($_SESSION['user_is'] != 'moderator'&&$_SESSION['user_is'] != 'systemadmin'){
				Yii::$app->session->setFlash('error', 'Access allowed to moderator and system admins only.');
				return $this->goHome();
		}
        //-------------------------------------------
        $courseid = Yii::$app->request->get('course_id');
        $userid = Yii::$app->session->get('user_id');
        $useris = Yii::$app->session->get('user_is');
        if($courseid!==null){
            Yii::$app->session->set('course_code',$courseid);
        }
        $searchModel = new ModeratorApprovalRequestsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        if ($courseid !== null) {
            if($useris=='moderator')
            $dataProvider->query->andFilterWhere(['course_id' => $courseid,'moderator_id'=>$userid]);
            else
            $dataProvider->query->andFilterWhere(['course_id' => $courseid,'admin_id'=>$userid]);
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ModeratorApprovalRequests model.
     * @param int $idModerator_Approval_Requests Id Moderator Approval Requests
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idModerator_Approval_Requests)
    {
        return $this->render('view', [
            'model' => $this->findModel($idModerator_Approval_Requests),
        ]);
    }

    /**
     * Creates a new ModeratorApprovalRequests model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        
        // Only a moderator can create a moderator request
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
    }

    /**
     * Updates an existing ModeratorApprovalRequests model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $idModerator_Approval_Requests Id Moderator Approval Requests
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idModerator_Approval_Requests)
    {
        // Only a system admin can update status of a moderator request
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
				Yii::$app->session->setFlash('error', 'Access allowed to system admin only.');
				return $this->goHome();
		}
		
		if($_SESSION['user_is'] != 'systemadmin'){
				Yii::$app->session->setFlash('error', 'Access allowed to system admin only.');
				return $this->goHome();
		}
        //-------------------------------------------
        $model = $this->findModel($idModerator_Approval_Requests);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idModerator_Approval_Requests' => $model->idModerator_Approval_Requests]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ModeratorApprovalRequests model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $idModerator_Approval_Requests Id Moderator Approval Requests
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idModerator_Approval_Requests)
    {
        // Only a system admin can delete a moderator request
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
				Yii::$app->session->setFlash('error', 'Access allowed to system admin only.');
				return $this->goHome();
		}
		
		if($_SESSION['user_is'] != 'systemadmin'){
				Yii::$app->session->setFlash('error', 'Access allowed to system admin only.');
				return $this->goHome();
		}
        //-------------------------------------------
        $this->findModel($idModerator_Approval_Requests)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ModeratorApprovalRequests model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idModerator_Approval_Requests Id Moderator Approval Requests
     * @return ModeratorApprovalRequests the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idModerator_Approval_Requests)
    {
        if (($model = ModeratorApprovalRequests::findOne(['idModerator_Approval_Requests' => $idModerator_Approval_Requests])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
