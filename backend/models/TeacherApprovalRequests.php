<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "teacher_approval_requests".
 *
 * @property int $idTeacher_Approval_Requests
 * @property int $teacher_id
 * @property int $Moderator_id
 * @property string|null $status
 * @property string|null $date_sent
 * @property string|null $firstname
 * @property string|null $lastname
 * @property string|null $phoneNo
 * @property string|null $qualifications
 * @property string|null $experience
 *
 * @property CoursesModerated $moderator
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
            [['idTeacher_Approval_Requests', 'teacher_id', 'Moderator_id'], 'required'],
            [['idTeacher_Approval_Requests', 'teacher_id', 'Moderator_id'], 'integer'],
            [['status', 'qualifications', 'experience'], 'string'],
            [['date_sent'], 'safe'],
            [['firstname', 'lastname'], 'string', 'max' => 45],
            [['phoneNo'], 'string', 'max' => 20],
            [['idTeacher_Approval_Requests'], 'unique'],
            [['Moderator_id'], 'exist', 'skipOnError' => true, 'targetClass' => CoursesModerated::class, 'targetAttribute' => ['Moderator_id' => 'idCourses_Moderated']],
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
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'phoneNo' => 'Phone No',
            'qualifications' => 'Qualifications',
            'experience' => 'Experience',
        ];
    }

    /**
     * Gets query for [[Moderator]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getModerator()
    {
        return $this->hasOne(CoursesModerated::class, ['idCourses_Moderated' => 'Moderator_id']);
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
