<?php

namespace backend\controllers;

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
        $searchModel = new TeacherApprovalRequestsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

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
        $model = new TeacherApprovalRequests();

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
