<?php

namespace backend\controllers;

use backend\models\Studentgameassignment;
use backend\models\StudentgameassignmentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StudentgameassignmentController implements the CRUD actions for Studentgameassignment model.
 */
class StudentgameassignmentController extends Controller
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
     * Lists all Studentgameassignment models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new StudentgameassignmentSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Studentgameassignment model.
     * @param int $idStudentGameAssignment Id Student Game Assignment
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idStudentGameAssignment)
    {
        return $this->render('view', [
            'model' => $this->findModel($idStudentGameAssignment),
        ]);
    }

    /**
     * Creates a new Studentgameassignment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Studentgameassignment();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'idStudentGameAssignment' => $model->idStudentGameAssignment]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Studentgameassignment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $idStudentGameAssignment Id Student Game Assignment
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idStudentGameAssignment)
    {
        $model = $this->findModel($idStudentGameAssignment);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idStudentGameAssignment' => $model->idStudentGameAssignment]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Studentgameassignment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $idStudentGameAssignment Id Student Game Assignment
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idStudentGameAssignment)
    {
        $this->findModel($idStudentGameAssignment)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Studentgameassignment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idStudentGameAssignment Id Student Game Assignment
     * @return Studentgameassignment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idStudentGameAssignment)
    {
        if (($model = Studentgameassignment::findOne(['idStudentGameAssignment' => $idStudentGameAssignment])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
