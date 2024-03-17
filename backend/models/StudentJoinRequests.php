<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "student_join_requests".
 *
 * @property int $idStudent_join_Requests
 * @property int $student_id
 * @property int $teacher_id
 * @property string $course_id
 * @property string $status
 *
 * @property Courses $course
 * @property Student $student
 * @property Teacher $teacher
 */
class StudentJoinRequests extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'student_join_requests';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idStudent_join_Requests', 'student_id', 'teacher_id', 'course_id', 'status'], 'required'],
            [['idStudent_join_Requests', 'student_id', 'teacher_id'], 'integer'],
            [['course_id'], 'string', 'max' => 10],
            [['status'], 'string', 'max' => 1],
            [['idStudent_join_Requests'], 'unique'],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Courses::class, 'targetAttribute' => ['course_id' => 'course_code']],
            [['teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teacher::class, 'targetAttribute' => ['teacher_id' => 'memberID']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => Student::class, 'targetAttribute' => ['student_id' => 'memberID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idStudent_join_Requests' => 'Id Student Join Requests',
            'student_id' => 'Student ID',
            'teacher_id' => 'Teacher ID',
            'course_id' => 'Course ID',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Course]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Courses::class, ['course_code' => 'course_id']);
    }

    /**
     * Gets query for [[Student]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Student::class, ['memberID' => 'student_id']);
    }

    /**
     * Gets query for [[Teacher]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTeacher()
    {
        return $this->hasOne(Teacher::class, ['memberID' => 'teacher_id']);
    }
}
