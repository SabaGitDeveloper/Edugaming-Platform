<?php

namespace backend\controllers;

use Yii;
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
    public function actionIndex()
    {
        $courseid = Yii::$app->request->get('course_code');
        if($courseid!==null){
            Yii::$app->session->set('course_code',$courseid);
        }
        $searchModel = new TopicSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
    
        if ($courseid !== null) {
            $dataProvider->query->andFilterWhere(['course_code' => $courseid]);
        }

        return $this->render('index', [
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
        // Only a teacher can create a topic
		if (Yii::$app->user->isGuest) {
			Yii::$app->session->setFlash('error', 'Access allowed after login.');
            return $this->goHome();
        }
		
		if(!isset($_SESSION['user_id'])){
				Yii::$app->session->setFlash('error', 'Session Expired. Please login again.');
				Yii::$app->user->logout();
				return $this->goHome();
		}
		
		if(!isset($_SESSION['user_is'])){
				Yii::$app->session->setFlash('error', 'Access allowed to teachers only.');
				return $this->goHome();
		}
		
		if($_SESSION['user_is'] != 'teacher'){
				Yii::$app->session->setFlash('error', 'Access allowed to teachers only.');
				return $this->goHome();
		}
        //-------------------------------------------
        $model = new Topic();
        $course_code=\Yii::$app->session->get('course_code');
        $model->course_code=$course_code;

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
        // Only a teacher can update a topic
		if (Yii::$app->user->isGuest) {
			Yii::$app->session->setFlash('error', 'Access allowed after login.');
            return $this->goHome();
        }
		
		if(!isset($_SESSION['user_id'])){
				Yii::$app->session->setFlash('error', 'Session Expired. Please login again.');
				Yii::$app->user->logout();
				return $this->goHome();
		}
		
		if(!isset($_SESSION['user_is'])){
				Yii::$app->session->setFlash('error', 'Access allowed to teachers only.');
				return $this->goHome();
		}
		
		if($_SESSION['user_is'] != 'teacher'){
				Yii::$app->session->setFlash('error', 'Access allowed to teachers only.');
				return $this->goHome();
		}
        //-------------------------------------------
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
        // Only a teacher can delete a topic
		if (Yii::$app->user->isGuest) {
			Yii::$app->session->setFlash('error', 'Access allowed after login.');
            return $this->goHome();
        }
		
		if(!isset($_SESSION['user_id'])){
				Yii::$app->session->setFlash('error', 'Session Expired. Please login again.');
				Yii::$app->user->logout();
				return $this->goHome();
		}
		
		if(!isset($_SESSION['user_is'])){
				Yii::$app->session->setFlash('error', 'Access allowed to teachers only.');
				return $this->goHome();
		}
		
		if($_SESSION['user_is'] != 'teacher'){
				Yii::$app->session->setFlash('error', 'Access allowed to teachers only.');
				return $this->goHome();
		}
        //-------------------------------------------
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
