<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "course_student".
 *
 * @property int $idCourse_Student
 * @property string $CourseID
 * @property int $Student_ID
 *
 * @property Courses $course
 * @property Student $student
 */
class CourseStudent extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'course_student';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['CourseID', 'Student_ID'], 'required'],
            [['Student_ID'], 'integer'],
            [['CourseID'], 'string', 'max' => 10],
            [['CourseID'], 'exist', 'skipOnError' => true, 'targetClass' => Courses::class, 'targetAttribute' => ['CourseID' => 'course_code']],
            [['Student_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Student::class, 'targetAttribute' => ['Student_ID' => 'memberID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idCourse_Student' => 'Id Course Student',
            'CourseID' => 'Course ID',
            'Student_ID' => 'Student ID',
        ];
    }

    /**
     * Gets query for [[Course]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Courses::class, ['course_code' => 'CourseID']);
    }

    /**
     * Gets query for [[Student]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Student::class, ['memberID' => 'Student_ID']);
    }
}
