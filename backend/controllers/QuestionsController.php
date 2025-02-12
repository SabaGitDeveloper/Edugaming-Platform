<?php

namespace backend\controllers;

use Yii;
use backend\models\Questions;
use backend\models\QuestionsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
    public function actionIndex()
    {
        $qsID=Yii::$app->request->get('question_setID');
       // $assID=Yii::$app->request->get('assignmentID');
        if($qsID!==null){
            Yii::$app->session->set('question_setID',$qsID);
        }
        // if($assID!==null){
        //     Yii::$app->session->set('assignmentID',$assID);
        // }
        $searchModel = new QuestionsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        if($qsID!==null){
            $dataProvider->query->andFilterWhere(['QuestionSet'=>$qsID]);
        }
        return $this->render('index', [
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
    public function actionCreate()
    {
        $model = new Questions();
        $questionsetID=\Yii::$app->session->get('question_setID');
        $model->QuestionSet=$questionsetID;

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
