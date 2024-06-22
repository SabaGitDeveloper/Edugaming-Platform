<?php

namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\User; //added by saba
use yii\web\Response;
use backend\models\Questions;
use backend\models\Options;
use backend\models\GameAssignments;
use backend\models\Studentgameassignment;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        // if (!Yii::$app->user->isGuest) {
        //     //Yii::$app->user->identity->user_type === 'teacher' added by sundus and muneeba
        //     if (Yii::$app->user->user_type === 'teacher') {
        //         Yii::$app->session->set('role', 'teacher');
        //         return $this->redirect(['teacher/index']);
        //     } else {
        //         // Handle other user types or unauthorized access
        //         return $this->goBack();
        //     }
        // } else {
        //     // Redirect to login if user is not authenticated
        //     return $this->redirect(['login']);
        // }
       return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            //return $this->goBack();
            //-----added by saba--------
            $user = User::findOne(['username' => $model->username]);
            Yii::$app->session->set('user_id', Yii::$app->user->id);
            Yii::$app->session->set('username', $model->username);
            if ($user && $user->user_type === 'student') {
                Yii::$app->session->set('role', 'student');
                return $this->render('sdashboard');
            }
            if ($user && $user->user_type === 'moderator') {
                Yii::$app->session->set('role', 'moderator');
                return $this->render('mdashboard');
            }
            if ($user && $user->user_type === 'admin') {
                Yii::$app->session->set('role', 'sysadmin');
                return $this->render('adashboard');
            }
            //------end of added--------------
            //added by muneeba---------
            if (Yii::$app->user->identity->user_type === 'teacher') {
                Yii::$app->session->set('role', 'teacher');
                return $this->redirect(['teacher/index']);
            } else {
                // Handle other user types or unauthorized access
                return $this->goBack();
            }
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    public function actionSdashboard()
    {
        return $this->render('sdashboard');
    }
    public function actionMdashboard()
    {
        return $this->render('mdashboard');
    }
    public function actionAdashboard()
    {
        return $this->render('adashboard');
    }
    public function actionCubegame()
    {
        return $this->render('cubegame');
    }
    public function actionPuzzlegame()
    {
        return $this->render('puzzlegame');
    }
    public function actionBubblegame()
    {
        return $this->render('bubblegame');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
    //---------------------------------------attempt for ajax----------------

    public function actionGetquestions()
    {
        $request = \Yii::$app->request;
        $qset= $request->get('qid');
        $inid=$request->get('inid');
        $assignmentId=$request->get('assid');
        \Yii::$app->response->format =  \yii\web\Response::FORMAT_JSON;
        try {
            $qset=Yii::$app->request->get('qid');
            if ($qset === null) {
                throw new \yii\web\BadRequestHttpException('Question set ID is required');
            }
            if (isset($_GET['assid'])) {
                $assignmentId = $_GET['assid'];
            } else {
                // Handle the case where 'qid' is not set
                throw new \yii\web\BadRequestHttpException('assignment ID is required');
            }
            $assignmentId=1;
            $qset=GameAssignments::find()->where(['assignmentID'=>$assignmentId])->one();
            $questions = Questions::find()->where(['QuestionSet' => $qset])->all();
            if (empty($questions)) {
                return ['error' => 'No questions found for the specified question set.'];
            }
            return $questions;
        } catch (\Exception $e) {
            // Log or handle the exception appropriately
            Yii::error($e->getMessage());
            return ['error' => 'Failed to fetch questions.'];
        }
    }
    public function actionGetoptions($index)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        try {
            $options = Options::find()->where(['questionNo' => $index])->all();
            return $options;
        } catch (\Exception $e) {
            // Log or handle the exception appropriately
            Yii::error($e->getMessage());
            return ['error' => 'Failed to fetch options.'];
        }
    }
    public function actionSaveScore()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        try {
        $assId=2;
        $studentId = \Yii::$app->session->get('user_id'); 
        $courseId = GameAssignments::find()->select('course_code')->where(['assignmentID'=>$assId])->one();
        //echo $courseId;
        if (!$courseId) {
            throw new \Exception('GameAssignment not found');
        }
        $score = Yii::$app->request->post('score');
        $accuracy = Yii::$app->request->post('accuracy');
        $speed = Yii::$app->request->post('speed');

        // Find existing record or create a new one
        $assignment = Studentgameassignment::find()->where([
            'StudentID' => $studentId,
            'CourseID' => $courseId,
        ])->one();

        if (!$assignment) {
            $assignment = new Studentgameassignment();
            $assignment->StudentID = $studentId;
            $assignment->CourseID = $courseId;
            $assignment->tries = 0;
        }

        $assignment->AssignmentId = $assId;
        $assignment->Accuracy = $accuracy;
        $assignment->Speed = $speed;
        $assignment->tries += 1;

        if ($assignment->save()) {
            return ['status' => 'success'];
        } else {
            return ['status' => 'error', 'errors' => $assignment->errors];
        }
        } catch (\Exception $e) {
            Yii::error($e->getMessage(), __METHOD__);
            return ['status' => 'error', 'message' => $e->getMessage()];
        }

    }
}
