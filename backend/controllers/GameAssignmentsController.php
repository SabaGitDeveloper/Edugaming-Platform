<?php

namespace backend\controllers;

use backend\models\GameAssignments;
use backend\models\GameAssignmentsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GameAssignmentsController implements the CRUD actions for GameAssignments model.
 */
class GameAssignmentsController extends Controller
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
     * Lists all GameAssignments models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new GameAssignmentsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GameAssignments model.
     * @param int $assignmentID Assignment ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($assignmentID)
    {
        return $this->render('view', [
            'model' => $this->findModel($assignmentID),
        ]);
    }

    /**
     * Creates a new GameAssignments model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new GameAssignments();
        $model->date_assigned=date('Y-m-d H:i:s');
        $model->course_code=\Yii::$app->request->get('course_code');
        $model->assigned_by=\Yii::$app->request->get('teacher_id');

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'assignmentID' => $model->assignmentID]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing GameAssignments model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $assignmentID Assignment ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($assignmentID)
    {
        $model = $this->findModel($assignmentID);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'assignmentID' => $model->assignmentID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing GameAssignments model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $assignmentID Assignment ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($assignmentID)
    {
        $this->findModel($assignmentID)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the GameAssignments model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $assignmentID Assignment ID
     * @return GameAssignments the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($assignmentID)
    {
        if (($model = GameAssignments::findOne(['assignmentID' => $assignmentID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
