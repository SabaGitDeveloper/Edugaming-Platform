<?php

namespace backend\controllers;
use Yii;
use yii\helpers\Url;
use backend\models\Courses;
use backend\models\CoursesSearch;
use backend\models\CourseStudentSearch;
use backend\models\CourseTeacherSearch;
use backend\models\CoursesModeratedSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CoursesController implements the CRUD actions for Courses model.
 */
class CoursesController extends Controller
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
     * Lists all Courses models.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (!isset($_SESSION['user_id'])) {
            Yii::$app->session->setFlash('error', 'Session Expired. Please login again.');
            Yii::$app->user->logout();
            return $this->goHome();
        }

        $userid = Yii::$app->session->get('user_id');
        $useris = Yii::$app->session->get('user_is');
    
        $searchModel = new CoursesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        // Apply additional filtering based on user role
        switch ($useris) {
            case 'teacher':
                $searchModelT = new CourseTeacherSearch();
                $dataProviderT = $searchModelT->search($this->request->queryParams);
                $dataProviderT->query->andFilterWhere(['Teacher_id' => $userid]);
                // Assuming course_code is a column in CourseTeacher table
                $dataProvider->query->andFilterWhere(['IN', 'course_code', $dataProviderT->query->select('Course_id')]);
                break;
        
            case 'student':
                $searchModelS = new CourseStudentSearch();
                $dataProviderS = $searchModelS->search($this->request->queryParams);
                $dataProviderS->query->andFilterWhere(['Student_id' => $userid]);
                $dataProvider->query->andFilterWhere(['IN', 'course_code', $dataProviderS->query->select('CourseID')]);
            break;
        
            case 'moderator':
                $searchModelM = new CoursesModeratedSearch();
                $dataProviderM = $searchModelM->search($this->request->queryParams);
                $dataProviderM->query->andFilterWhere(['moderator_id' => $userid]);
                $dataProvider->query->andFilterWhere(['IN', 'course_code', $dataProviderM->query->select('course_id')]);
                break;
        }   

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Courses model.
     * @param string $course_code Course Code
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($course_code)
    {
        return $this->render('view', [
            'model' => $this->findModel($course_code),
        ]);
    }

    /**
     * Creates a new Courses model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        // Only a teacher can create a course
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
        $model = new Courses();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'course_code' => $model->course_code]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Courses model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $course_code Course Code
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($course_code)
    {
         // Only a teacher can update a course
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
        $model = $this->findModel($course_code);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'course_code' => $model->course_code]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Courses model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $course_code Course Code
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($course_code)
    {
        // Only a teacher can delete a course
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
        $this->findModel($course_code)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Courses model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $course_code Course Code
     * @return Courses the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($course_code)
    {
        if (($model = Courses::findOne(['course_code' => $course_code])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
