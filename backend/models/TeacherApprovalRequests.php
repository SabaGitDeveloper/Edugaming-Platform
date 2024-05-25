<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "teacher_approval_requests".
 *
 * @property int $idTeacher_Approval_Requests
 * @property int $teacher_id
 * @property int|null $Moderator_id
 * @property string|null $status
 * @property string|null $date_sent
 * @property string|null $phoneNo
 * @property string|null $qualifications
 * @property string|null $experience
 * @property string|null $course_id
 *
 * @property Courses $course
 * @property Teacher $teacher
 */
class TeacherApprovalRequests extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'teacher_approval_requests';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['teacher_id'], 'required'],
            [['teacher_id', 'Moderator_id'], 'integer'],
            [['status', 'qualifications', 'experience'], 'string'],
            [['date_sent'], 'safe'],
            [['phoneNo'], 'string', 'max' => 20],
            [['course_id'], 'string', 'max' => 10],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Courses::class, 'targetAttribute' => ['course_id' => 'course_code']],
            [['teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teacher::class, 'targetAttribute' => ['teacher_id' => 'memberID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idTeacher_Approval_Requests' => 'Id Teacher Approval Requests',
            'teacher_id' => 'Teacher ID',
            'Moderator_id' => 'Moderator ID',
            'status' => 'Status',
            'date_sent' => 'Date Sent',
            'phoneNo' => 'Phone No',
            'qualifications' => 'Qualifications',
            'experience' => 'Experience',
            'course_id' => 'Course ID',
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
     * Gets query for [[Teacher]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTeacher()
    {
        return $this->hasOne(Teacher::class, ['memberID' => 'teacher_id']);
    }
}
