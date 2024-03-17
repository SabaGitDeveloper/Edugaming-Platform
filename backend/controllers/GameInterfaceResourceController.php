<?php

namespace backend\controllers;

use backend\models\GameInterfaceResource;
use backend\models\GameInterfaceResourceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GameInterfaceResourceController implements the CRUD actions for GameInterfaceResource model.
 */
class GameInterfaceResourceController extends Controller
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
     * Lists all GameInterfaceResource models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new GameInterfaceResourceSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GameInterfaceResource model.
     * @param int $idGameInterfaceResource Id Game Interface Resource
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idGameInterfaceResource)
    {
        return $this->render('view', [
            'model' => $this->findModel($idGameInterfaceResource),
        ]);
    }

    /**
     * Creates a new GameInterfaceResource model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new GameInterfaceResource();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'idGameInterfaceResource' => $model->idGameInterfaceResource]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing GameInterfaceResource model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $idGameInterfaceResource Id Game Interface Resource
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idGameInterfaceResource)
    {
        $model = $this->findModel($idGameInterfaceResource);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idGameInterfaceResource' => $model->idGameInterfaceResource]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing GameInterfaceResource model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $idGameInterfaceResource Id Game Interface Resource
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idGameInterfaceResource)
    {
        $this->findModel($idGameInterfaceResource)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the GameInterfaceResource model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idGameInterfaceResource Id Game Interface Resource
     * @return GameInterfaceResource the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idGameInterfaceResource)
    {
        if (($model = GameInterfaceResource::findOne(['idGameInterfaceResource' => $idGameInterfaceResource])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
