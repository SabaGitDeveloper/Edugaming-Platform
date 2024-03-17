<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "courses".
 *
 * @property string $course_code
 * @property string $course_name
 * @property string $course_description
 *
 * @property CourseTeacher[] $courseTeachers
 * @property CourseTopics[] $courseTopics
 * @property CoursesModerated[] $coursesModerateds
 * @property GameAssignemnts $gameAssignemnts
 * @property QuestionSet[] $questionSets
 * @property StudentJoinRequests[] $studentJoinRequests
 * @property Studentcourseenrollment[] $studentcourseenrollments
 * @property Studentgameassignment[] $studentgameassignments
 */
class Courses extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'courses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['course_code', 'course_name', 'course_description'], 'required'],
            [['course_description'], 'string'],
            [['course_code'], 'string', 'max' => 10],
            [['course_name'], 'string', 'max' => 45],
            [['course_code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'course_code' => 'Course Code',
            'course_name' => 'Course Name',
            'course_description' => 'Course Description',
        ];
    }

    /**
     * Gets query for [[CourseTeachers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourseTeachers()
    {
        return $this->hasMany(CourseTeacher::class, ['Course_id' => 'course_code']);
    }

    /**
     * Gets query for [[CourseTopics]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourseTopics()
    {
        return $this->hasMany(CourseTopics::class, ['CourseCode' => 'course_code']);
    }

    /**
     * Gets query for [[CoursesModerateds]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCoursesModerateds()
    {
        return $this->hasMany(CoursesModerated::class, ['course_id' => 'course_code']);
    }

    /**
     * Gets query for [[GameAssignemnts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGameAssignemnts()
    {
        return $this->hasOne(GameAssignemnts::class, ['course_code' => 'course_code']);
    }

    /**
     * Gets query for [[QuestionSets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionSets()
    {
        return $this->hasMany(QuestionSet::class, ['course_code' => 'course_code']);
    }

    /**
     * Gets query for [[StudentJoinRequests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentJoinRequests()
    {
        return $this->hasMany(StudentJoinRequests::class, ['course_id' => 'course_code']);
    }

    /**
     * Gets query for [[Studentcourseenrollments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentcourseenrollments()
    {
        return $this->hasMany(Studentcourseenrollment::class, ['CourseID' => 'course_code']);
    }

    /**
     * Gets query for [[Studentgameassignments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentgameassignments()
    {
        return $this->hasMany(Studentgameassignment::class, ['CourseID' => 'course_code']);
    }
}
