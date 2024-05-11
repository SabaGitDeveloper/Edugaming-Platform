<?php

namespace frontend\controllers;

use Yii;
use backend\models\Courses;
use backend\models\CoursesSearch;
use backend\models\CourseStudent;
use backend\models\CourseTeacher;
use backend\models\Student;
use backend\models\Teacher;
use backend\models\Topic;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\User;

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

        $teacherId = Yii::$app->user->identity->id;
        $courseIds = CourseTeacher::find()->select('Course_id')->where(['Teacher_id' => $teacherId])->column();

        $searchModel = new CoursesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->andWhere(['IN', 'course_code', $courseIds]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
   
    public function actionTopics($course_code)
    {
        $course = Courses::findOne(['course_code' => $course_code]);
        if (!$course) {
            throw new NotFoundHttpException('The requested course does not exist.');
        }
    
        // Retrieve topics related to the provided course code
        $topics = Topic::find()->where(['course_code' => $course_code])->all();
    
        return $this->render('topics', [
            'course' => $course,
            'topics' => $topics,
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
        $model = new Courses();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                $courseTeacher = new CourseTeacher();
                $courseTeacher->Course_id = $model->course_code;
                $courseTeacher->Teacher_id = Yii::$app->user->identity->id;
                $courseTeacher->save();
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
        $this->findModel($course_code)->delete();

        return $this->redirect(['index']);
    }

    public function actionTeacherCourses()
    {
        $teacherId = Yii::$app->user->identity->id;
        $model=new Courses();

        // Find all courses associated with the teacher from the CourseTeacher model
        $courseIds = CourseTeacher::find()->select('Course_id')->where(['Teacher_id' => $teacherId])->column();

        // Find the courses based on the IDs fetched
        $searchModel = new CoursesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->andWhere(['IN', 'course_code', $courseIds]);

        return $this->render('teacher-courses', [
            'model'=>$model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
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

    public function actionCourseStudents($course_code)
    {
        $enrolledStudents = CourseStudent::find()->where(['CourseID' => $course_code])->all();

        $studentNames = [];
        foreach ($enrolledStudents as $enrolledStudent) {
            $studentId = $enrolledStudent->student->memberID; 
            $student = User::findOne($studentId); 
            if ($student !== null) {
                $studentNames[] = $student->username; 
            }
        }

        return $this->render('course-students', [
            'enrolledStudents' => $enrolledStudents,
            'studentNames' => $studentNames, 
        ]);
    }
}
