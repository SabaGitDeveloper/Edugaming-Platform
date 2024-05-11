<?php

namespace frontend\controllers;

use backend\models\Topic;
use backend\models\TopicSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TopicController implements the CRUD actions for Topic model.
 */
class TopicController extends Controller
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
     * Lists all Topic models.
     *
     * @return string
     */
    public function actionIndex($course_code)
    {
        $searchModel = new TopicSearch();
        $model=new Topic();
        $model->course_code=$course_code;
        $dataProvider = $searchModel->search(array_merge($this->request->queryParams,['TopicSearch' => ['course_code' => $course_code]]));
        
        return $this->render('index', [
            'model'=>$model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCourseTopics($course_code)
    {
        $searchModel = new TopicSearch();
        $model=new Topic();
        $model->course_code=$course_code;
        $dataProvider = $searchModel->search(array_merge($this->request->queryParams,['TopicSearch' => ['course_code' => $course_code]]));
        
        return $this->render('course-topics', [
            'model'=>$model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Topic model.
     * @param int $topicID Topic ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($topicID)
    {
        return $this->render('view', [
            'model' => $this->findModel($topicID),
        ]);
    }
    

    /**
     * Creates a new Topic model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Topic();
        $course_code = \Yii::$app->request->get('course_code'); 
        $model->course_code = $course_code;

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'topicID' => $model->topicID]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Topic model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $topicID Topic ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($topicID)
    {
        $model = $this->findModel($topicID);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'topicID' => $model->topicID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Topic model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $topicID Topic ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($topicID)
    {
        $this->findModel($topicID)->delete();

        return $this->redirect(['index']);
    }


    /**
     * Finds the Topic model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $topicID Topic ID
     * @return Topic the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($topicID)
    {
        if (($model = Topic::findOne(['topicID' => $topicID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
