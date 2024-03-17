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
 *
 * @property Courses $courseCode
 * @property QuestionSet $questionSet
 * @property Studentgameassignment[] $studentgameassignments
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
            [['course_code', 'assigned_by', 'date_assigned', 'due_date', 'game_mode', 'interface_type', 'question_setID'], 'required'],
            [['assigned_by', 'interface_type', 'question_setID'], 'integer'],
            [['course_code'], 'string', 'max' => 10],
            [['date_assigned', 'due_date'], 'string', 'max' => 30],
            [['game_mode'], 'string', 'max' => 45],
            [['course_code'], 'unique'],
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
}
