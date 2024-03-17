<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "moderator_approval_requests".
 *
 * @property int $idModerator_Approval_Requests
 * @property int $moderator_id
 * @property int $admin_id
 * @property string|null $status
 * @property string|null $firstname
 * @property string|null $lastname
 * @property string|null $phoneNo
 * @property string|null $qualifications
 * @property string|null $experience
 * @property string|null $date_sent
 * @property string|null $course_id
 *
 * @property SystemAdmin $admin
 * @property Courses $course
 * @property Moderator $moderator
 */
class ModeratorApprovalRequests extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'moderator_approval_requests';
    }

    /**
     * {@inheritdoc}
     */
    //            [['idModerator_Approval_Requests', 'moderator_id', 'admin_id'], 'required'],
    public function rules()
    {
        return [

            [['idModerator_Approval_Requests', 'moderator_id', 'admin_id'], 'integer'],
            [['status', 'qualifications', 'experience'], 'string'],
            [['date_sent'], 'safe'],
            [['firstname', 'lastname'], 'string', 'max' => 45],
            [['phoneNo'], 'string', 'max' => 20],
            [['course_id'], 'string', 'max' => 10],
            [['idModerator_Approval_Requests'], 'unique'],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Courses::class, 'targetAttribute' => ['course_id' => 'course_code']],
            [['moderator_id'], 'exist', 'skipOnError' => true, 'targetClass' => Moderator::class, 'targetAttribute' => ['moderator_id' => 'memberID']],
            [['admin_id'], 'exist', 'skipOnError' => true, 'targetClass' => SystemAdmin::class, 'targetAttribute' => ['admin_id' => 'memberID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idModerator_Approval_Requests' => 'Id Moderator Approval Requests',
            'moderator_id' => 'Moderator ID',
            'admin_id' => 'Admin ID',
            'status' => 'Status',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'phoneNo' => 'Phone No',
            'qualifications' => 'Qualifications',
            'experience' => 'Experience',
            'date_sent' => 'Date Sent',
            'course_id' => 'Course ID',
        ];
    }

    /**
     * Gets query for [[Admin]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAdmin()
    {
        return $this->hasOne(SystemAdmin::class, ['memberID' => 'admin_id']);
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
     * Gets query for [[Moderator]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getModerator()
    {
        return $this->hasOne(Moderator::class, ['memberID' => 'moderator_id']);
    }
}
