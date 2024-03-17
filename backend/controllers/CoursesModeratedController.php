<?php

namespace backend\controllers;

use backend\models\CoursesModerated;
use backend\models\CoursesModeratedSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CoursesModeratedController implements the CRUD actions for CoursesModerated model.
 */
class CoursesModeratedController extends Controller
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
     * Lists all CoursesModerated models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CoursesModeratedSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CoursesModerated model.
     * @param int $idCourses_Moderated Id Courses Moderated
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idCourses_Moderated)
    {
        return $this->render('view', [
            'model' => $this->findModel($idCourses_Moderated),
        ]);
    }

    /**
     * Creates a new CoursesModerated model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new CoursesModerated();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'idCourses_Moderated' => $model->idCourses_Moderated]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CoursesModerated model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $idCourses_Moderated Id Courses Moderated
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idCourses_Moderated)
    {
        $model = $this->findModel($idCourses_Moderated);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idCourses_Moderated' => $model->idCourses_Moderated]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CoursesModerated model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $idCourses_Moderated Id Courses Moderated
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idCourses_Moderated)
    {
        $this->findModel($idCourses_Moderated)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CoursesModerated model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idCourses_Moderated Id Courses Moderated
     * @return CoursesModerated the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idCourses_Moderated)
    {
        if (($model = CoursesModerated::findOne(['idCourses_Moderated' => $idCourses_Moderated])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
