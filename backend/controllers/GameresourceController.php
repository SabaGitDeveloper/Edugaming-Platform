<?php

namespace backend\controllers;

use backend\models\Gameresource;
use backend\models\GameresourceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GameresourceController implements the CRUD actions for Gameresource model.
 */
class GameresourceController extends Controller
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
     * Lists all Gameresource models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new GameresourceSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Gameresource model.
     * @param int $idGameResource Id Game Resource
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idGameResource)
    {
        return $this->render('view', [
            'model' => $this->findModel($idGameResource),
        ]);
    }

    /**
     * Creates a new Gameresource model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Gameresource();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'idGameResource' => $model->idGameResource]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Gameresource model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $idGameResource Id Game Resource
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idGameResource)
    {
        $model = $this->findModel($idGameResource);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idGameResource' => $model->idGameResource]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Gameresource model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $idGameResource Id Game Resource
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idGameResource)
    {
        $this->findModel($idGameResource)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Gameresource model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idGameResource Id Game Resource
     * @return Gameresource the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idGameResource)
    {
        if (($model = Gameresource::findOne(['idGameResource' => $idGameResource])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
