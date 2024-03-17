<?php

namespace backend\controllers;

use backend\models\Moderator;
use backend\models\ModeratorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ModeratorController implements the CRUD actions for Moderator model.
 */
class ModeratorController extends Controller
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
     * Lists all Moderator models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ModeratorSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Moderator model.
     * @param int $memberID Member ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($memberID)
    {
        return $this->render('view', [
            'model' => $this->findModel($memberID),
        ]);
    }

    /**
     * Creates a new Moderator model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Moderator();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'memberID' => $model->memberID]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Moderator model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $memberID Member ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($memberID)
    {
        $model = $this->findModel($memberID);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'memberID' => $model->memberID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Moderator model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $memberID Member ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($memberID)
    {
        $this->findModel($memberID)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Moderator model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $memberID Member ID
     * @return Moderator the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($memberID)
    {
        if (($model = Moderator::findOne(['memberID' => $memberID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
