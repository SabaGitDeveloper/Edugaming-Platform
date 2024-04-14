<?php

namespace backend\controllers;

use Yii;
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
        // $courseid = Yii::$app->request->get('course_code');
        // if($courseid!==null){
        //     Yii::$app->session->set('course_code',$courseid);
        // }
        $searchModel = new GameAssignmentsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        // if ($courseid !== null) {
        //     $dataProvider->query->andFilterWhere(['course_code' => $courseid]);
        // }
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
        // Only a teacher can create a gameassignment
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
        $model = new GameAssignments();
        // $model->date_assigned=date('Y-m-d H:i:s');
        // $model->course_code=\Yii::$app->request->get('course_code');
        // $model->assigned_by=\Yii::$app->session->get('user_id');

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                //--------------added by saba-----
                $model->date_assigned = date('Y-m-d'); // Assign current date
                $dueDate = date('Y-m-d', strtotime('+7 days', strtotime($model->date_assigned))); // Calculate due date
                $model->due_date = $dueDate; // Assign due date  
                //----end of addition-----------  
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
        // Only a teacher can update a gameassignment
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
        // Only a teacher can delete a game assignment
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
