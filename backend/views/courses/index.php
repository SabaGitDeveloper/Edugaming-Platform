<?php
use backend\models\Courses;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\CoursesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Courses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="courses-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Courses', ['create'], ['class' => 'btn btn-success']) ?>
        <?php 
        if (isset($_SESSION['user_id'])) { 
            echo $_SESSION['user_id'];
            echo $_SESSION['user_is'];
        }
        else 
            echo "User is not logged in.";
        ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'course_code',
            'course_name',
            'course_description:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Courses $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'course_code' => $model->course_code]);
                 }
            ],
            [
                'label' => 'Student Join Requests',
                'value' => function ($model) {
                    $joinRequests = $model->studentJoinRequests; // Assuming there's a relation named 'studentJoinRequests'
                    $requestsList = '';
                    foreach ($joinRequests as $request) {
                        $requestsList .= $request->firstname . '<br>'; // Assuming student_name is the attribute for student's name
                    }
                    return $requestsList;
                },
                'format' => 'html',
            ],
            [
                'label' => 'Teacher Approval Requests',
                'value' => function ($model) {
                    $joinRequests = $model->teacherApprovalRequests; // Assuming there's a relation named 'studentJoinRequests'
                    $requestsList = '';
                    foreach ($joinRequests as $request) {
                        $requestsList .= $request->firstname . '<br>'; // Assuming student_name is the attribute for student's name
                    }
                    return $requestsList;
                },
                'format' => 'html',
            ],
            [
                'label' => 'Moderator Approval Requests',
                'value' => function ($model) {
                    $joinRequests = $model->moderatorApprovalRequests; // Assuming there's a relation named 'studentJoinRequests'
                    $requestsList = '';
                    foreach ($joinRequests as $request) {
                        $requestsList .= $request->firstname . '<br>'; // Assuming student_name is the attribute for student's name
                    }
                    return $requestsList;
                },
                'format' => 'html',
            ],

        ],
    ]); ?> 
</div> 
