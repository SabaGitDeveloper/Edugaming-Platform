<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "game_assignments".
 *
 * @property int $assignmentID
 * @property string $course_code
 * @property int $assigned_by
 * @property string $date_assigned
 * @property string $due_date
 * @property string $game_mode
 * @property int $interface_type
 * @property int $question_setID
 * @property int|null $topicId  //new added
 *
 * @property Courses $courseCode
 * @property QuestionSet $questionSet
 * @property Studentgameassignment[] $studentgameassignments
 * @property Topic $topic   //new added
 */
class GameAssignments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'game_assignments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           // [['course_code', 'assigned_by', 'date_assigned', 'due_date', 'game_mode', 'interface_type', 'question_setID'], 'required'],
           [['course_code', 'assigned_by', 'interface_type', 'question_setID'], 'required'],    //added by saba
            [['assigned_by', 'interface_type', 'question_setID','topicId'], 'integer'],
            [['course_code'], 'string', 'max' => 10],
           // [['date_assigned', 'due_date'], 'string', 'max' => 30],
            [['date_assigned','due_date'],'safe'],  //added by saba
            [['game_mode'], 'string', 'max' => 45],
            [['course_code'], 'unique'],
            [['topicId'], 'exist', 'skipOnError' => true, 'targetClass' => Topic::class, 'targetAttribute' => ['topicId' => 'topicID']],    //added by saba
            [['course_code'], 'exist', 'skipOnError' => true, 'targetClass' => Courses::class, 'targetAttribute' => ['course_code' => 'course_code']],
            [['question_setID'], 'exist', 'skipOnError' => true, 'targetClass' => QuestionSet::class, 'targetAttribute' => ['question_setID' => 'question_setID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'assignmentID' => 'Assignment ID',
            'course_code' => 'Course Code',
            'assigned_by' => 'Assigned By',
            'date_assigned' => 'Date Assigned',
            'due_date' => 'Due Date',
            'game_mode' => 'Game Mode',
            'interface_type' => 'Interface Type',
            'question_setID' => 'Question Set ID',
            'topicId' => 'Topic ID',    //added by saba
        ];
    }

    /**
     * Gets query for [[CourseCode]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourseCode()
    {
        return $this->hasOne(Courses::class, ['course_code' => 'course_code']);
    }

    /**
     * Gets query for [[QuestionSet]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionSet()
    {
        return $this->hasOne(QuestionSet::class, ['question_setID' => 'question_setID']);
    }

    /**
     * Gets query for [[Studentgameassignments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentgameassignments()
    {
        return $this->hasMany(Studentgameassignment::class, ['AssignmentId' => 'assignmentID']);
    }
    //--------------------added by saba----------------
    /**
     * Gets query for [[Topic]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTopic()
    {
        return $this->hasOne(Topic::class, ['topicID' => 'topicId']);
    }
}
