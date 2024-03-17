<?php

namespace backend\controllers;

use backend\models\QuestionSet;
use backend\models\QuestionSetSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * QuestionSetController implements the CRUD actions for QuestionSet model.
 */
class QuestionSetController extends Controller
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
     * Lists all QuestionSet models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new QuestionSetSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single QuestionSet model.
     * @param int $question_setID Question Set ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($question_setID)
    {
        return $this->render('view', [
            'model' => $this->findModel($question_setID),
        ]);
    }

    /**
     * Creates a new QuestionSet model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new QuestionSet();
        $topicID=\Yii::$app->request->get('topicID');
        $model->topicID=$topicID;

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'question_setID' => $model->question_setID]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing QuestionSet model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $question_setID Question Set ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($question_setID)
    {
        $model = $this->findModel($question_setID);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'question_setID' => $model->question_setID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing QuestionSet model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $question_setID Question Set ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($question_setID)
    {
        $this->findModel($question_setID)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the QuestionSet model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $question_setID Question Set ID
     * @return QuestionSet the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($question_setID)
    {
        if (($model = QuestionSet::findOne(['question_setID' => $question_setID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
