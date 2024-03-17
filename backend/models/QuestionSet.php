<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "question_set".
 *
 * @property int $question_setID
 * @property int $topicID
 * @property string $course_code
 * @property string $date_created
 * @property int $created_by
 * @property string $difficulty_level
 * @property string $approval_status
 *
 * @property Courses $courseCode
 * @property Teacher $createdBy
 * @property GameAssignemnts[] $gameAssignemnts
 * @property Gameinterfacecompatibility[] $gameinterfacecompatibilities
 * @property Questions[] $questions
 * @property Topic $topic
 */
class QuestionSet extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'question_set';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['topicID', 'course_code', 'date_created', 'created_by', 'difficulty_level', 'approval_status'], 'required'],
            [['topicID', 'created_by'], 'integer'],
            [['course_code'], 'string', 'max' => 10],
            [['date_created', 'difficulty_level'], 'string', 'max' => 30],
            [['approval_status'], 'string', 'max' => 1],
            [['course_code'], 'exist', 'skipOnError' => true, 'targetClass' => Courses::class, 'targetAttribute' => ['course_code' => 'course_code']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => Teacher::class, 'targetAttribute' => ['created_by' => 'memberID']],
            [['topicID'], 'exist', 'skipOnError' => true, 'targetClass' => Topic::class, 'targetAttribute' => ['topicID' => 'topicID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'question_setID' => 'Question Set ID',
            'topicID' => 'Topic ID',
            'course_code' => 'Course Code',
            'date_created' => 'Date Created',
            'created_by' => 'Created By',
            'difficulty_level' => 'Difficulty Level',
            'approval_status' => 'Approval Status',
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
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(Teacher::class, ['memberID' => 'created_by']);
    }

    /**
     * Gets query for [[GameAssignemnts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGameAssignemnts()
    {
        return $this->hasMany(GameAssignemnts::class, ['question_setID' => 'question_setID']);
    }

    /**
     * Gets query for [[Gameinterfacecompatibilities]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGameinterfacecompatibilities()
    {
        return $this->hasMany(Gameinterfacecompatibility::class, ['QuestionSetid' => 'question_setID']);
    }

    /**
     * Gets query for [[Questions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasMany(Questions::class, ['QuestionSet' => 'question_setID']);
    }

    /**
     * Gets query for [[Topic]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTopic()
    {
        return $this->hasOne(Topic::class, ['topicID' => 'topicID']);
    }
}
