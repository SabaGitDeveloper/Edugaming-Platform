<?php

namespace backend\controllers;

use backend\models\StudentJoinRequests;
use backend\models\StudentJoinRequestsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StudentJoinRequestsController implements the CRUD actions for StudentJoinRequests model.
 */
class StudentJoinRequestsController extends Controller
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
     * Lists all StudentJoinRequests models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new StudentJoinRequestsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StudentJoinRequests model.
     * @param int $idStudent_join_Requests Id Student Join Requests
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idStudent_join_Requests)
    {
        return $this->render('view', [
            'model' => $this->findModel($idStudent_join_Requests),
        ]);
    }

    /**
     * Creates a new StudentJoinRequests model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new StudentJoinRequests();
        $model->status='pending';
        $model->date_sent=date('Y-m-d H:i:s');
        $model->course_id=\Yii::$app->request->get('course_id');
        $model->teacher_id=\Yii::$app->request->get('teacher_id') ;

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'idStudent_join_Requests' => $model->idStudent_join_Requests]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing StudentJoinRequests model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $idStudent_join_Requests Id Student Join Requests
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idStudent_join_Requests)
    {
        $model = $this->findModel($idStudent_join_Requests);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idStudent_join_Requests' => $model->idStudent_join_Requests]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing StudentJoinRequests model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $idStudent_join_Requests Id Student Join Requests
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idStudent_join_Requests)
    {
        $this->findModel($idStudent_join_Requests)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the StudentJoinRequests model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idStudent_join_Requests Id Student Join Requests
     * @return StudentJoinRequests the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idStudent_join_Requests)
    {
        if (($model = StudentJoinRequests::findOne(['idStudent_join_Requests' => $idStudent_join_Requests])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
