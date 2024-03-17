<?php

namespace backend\controllers;

use backend\models\CourseTeacher;
use backend\models\CourseTeacherSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CourseTeacherController implements the CRUD actions for CourseTeacher model.
 */
class CourseTeacherController extends Controller
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
     * Lists all CourseTeacher models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CourseTeacherSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CourseTeacher model.
     * @param int $idCourse_Teacher Id Course Teacher
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idCourse_Teacher)
    {
        return $this->render('view', [
            'model' => $this->findModel($idCourse_Teacher),
        ]);
    }

    /**
     * Creates a new CourseTeacher model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new CourseTeacher();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'idCourse_Teacher' => $model->idCourse_Teacher]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CourseTeacher model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $idCourse_Teacher Id Course Teacher
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idCourse_Teacher)
    {
        $model = $this->findModel($idCourse_Teacher);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idCourse_Teacher' => $model->idCourse_Teacher]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CourseTeacher model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $idCourse_Teacher Id Course Teacher
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idCourse_Teacher)
    {
        $this->findModel($idCourse_Teacher)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CourseTeacher model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idCourse_Teacher Id Course Teacher
     * @return CourseTeacher the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idCourse_Teacher)
    {
        if (($model = CourseTeacher::findOne(['idCourse_Teacher' => $idCourse_Teacher])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
