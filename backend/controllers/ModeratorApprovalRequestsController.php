<?php

namespace backend\controllers;

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
        $searchModel = new ModeratorApprovalRequestsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

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
        $model = new ModeratorApprovalRequests();
        $model->status='pending';
        $model->date_sent=date('Y-m-d H:i:s');
        $model->course_id=\Yii::$app->request->get('course_id');
        $model->moderator_id=\Yii::$app->request->get('admin_id') ;

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
