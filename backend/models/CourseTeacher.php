<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "course_teacher".
 *
 * @property int $idCourse_Teacher
 * @property string $Course_id
 * @property int $Teacher_id
 * @property string $is_active
 *
 * @property Courses $course
 * @property Teacher $teacher
 */
class CourseTeacher extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'course_teacher';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idCourse_Teacher', 'Course_id', 'Teacher_id', 'is_active'], 'required'],
            [['idCourse_Teacher', 'Teacher_id'], 'integer'],
            [['Course_id'], 'string', 'max' => 10],
            [['is_active'], 'string', 'max' => 1],
            [['idCourse_Teacher'], 'unique'],
            [['Teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teacher::class, 'targetAttribute' => ['Teacher_id' => 'memberID']],
            [['Course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Courses::class, 'targetAttribute' => ['Course_id' => 'course_code']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idCourse_Teacher' => 'Id Course Teacher',
            'Course_id' => 'Course ID',
            'Teacher_id' => 'Teacher ID',
            'is_active' => 'Is Active',
        ];
    }

    /**
     * Gets query for [[Course]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Courses::class, ['course_code' => 'Course_id']);
    }

    /**
     * Gets query for [[Teacher]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTeacher()
    {
        return $this->hasOne(Teacher::class, ['memberID' => 'Teacher_id']);
    }
}
