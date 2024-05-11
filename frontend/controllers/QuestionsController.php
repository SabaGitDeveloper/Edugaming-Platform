<?php

namespace frontend\controllers;

use backend\models\Questions;
use backend\models\QuestionsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * QuestionsController implements the CRUD actions for Questions model.
 */
class QuestionsController extends Controller
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
     * Lists all Questions models.
     *
     * @return string
     */
    public function actionIndex($question_setID)
    {
        $searchModel = new QuestionsSearch();
        $model=new Questions();
        $model->QuestionSet=$question_setID;
        $dataProvider = $searchModel->search(array_merge($this->request->queryParams, ['QuestionsSearch' => ['QuestionSet' => $question_setID]]));
        return $this->render('index', [
            'model'=>$model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSetQuestions($question_setID)
    {
        $searchModel = new QuestionsSearch();
        $model=new Questions();
        $model->QuestionSet=$question_setID;
        $dataProvider = $searchModel->search(array_merge($this->request->queryParams, ['QuestionsSearch' => ['QuestionSet' => $question_setID]]));
        return $this->render('set-questions', [
            'model'=>$model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays a single Questions model.
     * @param int $QuestionNo Question No
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($QuestionNo)
    {
        return $this->render('view', [
            'model' => $this->findModel($QuestionNo),
        ]);
    }

    /**
     * Creates a new Questions model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($question_setID)
    {
        $model = new Questions();
        //$question_setID = \Yii::$app->request->get('question_setID'); 
        $model->QuestionSet=$question_setID;

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'QuestionNo' => $model->QuestionNo]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Questions model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $QuestionNo Question No
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($QuestionNo)
    {
        $model = $this->findModel($QuestionNo);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'QuestionNo' => $model->QuestionNo]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Questions model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $QuestionNo Question No
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($QuestionNo)
    {
        $this->findModel($QuestionNo)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Questions model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $QuestionNo Question No
     * @return Questions the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($QuestionNo)
    {
        if (($model = Questions::findOne(['QuestionNo' => $QuestionNo])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
