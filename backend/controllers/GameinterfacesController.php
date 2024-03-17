<?php

namespace backend\controllers;

use backend\models\Gameinterfaces;
use backend\models\GameinterfacesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GameinterfacesController implements the CRUD actions for Gameinterfaces model.
 */
class GameinterfacesController extends Controller
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
     * Lists all Gameinterfaces models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new GameinterfacesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Gameinterfaces model.
     * @param int $idGameInterfaces Id Game Interfaces
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idGameInterfaces)
    {
        return $this->render('view', [
            'model' => $this->findModel($idGameInterfaces),
        ]);
    }

    /**
     * Creates a new Gameinterfaces model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Gameinterfaces();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'idGameInterfaces' => $model->idGameInterfaces]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Gameinterfaces model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $idGameInterfaces Id Game Interfaces
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idGameInterfaces)
    {
        $model = $this->findModel($idGameInterfaces);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idGameInterfaces' => $model->idGameInterfaces]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Gameinterfaces model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $idGameInterfaces Id Game Interfaces
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idGameInterfaces)
    {
        $this->findModel($idGameInterfaces)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Gameinterfaces model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idGameInterfaces Id Game Interfaces
     * @return Gameinterfaces the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idGameInterfaces)
    {
        if (($model = Gameinterfaces::findOne(['idGameInterfaces' => $idGameInterfaces])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
