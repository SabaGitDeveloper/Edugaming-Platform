<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "teacher_approval_requests".
 *
 * @property int $idTeacher_Approval_Requests
 * @property int $teacher_id
 * @property int $Moderator_id
 * @property string $status
 *
 * @property Moderator $moderator
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
            [['idTeacher_Approval_Requests', 'teacher_id', 'Moderator_id', 'status'], 'required'],
            [['idTeacher_Approval_Requests', 'teacher_id', 'Moderator_id'], 'integer'],
            [['status'], 'string', 'max' => 1],
            [['idTeacher_Approval_Requests'], 'unique'],
            [['teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teacher::class, 'targetAttribute' => ['teacher_id' => 'memberID']],
            [['Moderator_id'], 'exist', 'skipOnError' => true, 'targetClass' => Moderator::class, 'targetAttribute' => ['Moderator_id' => 'memberID']],
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
        ];
    }

    /**
     * Gets query for [[Moderator]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getModerator()
    {
        return $this->hasOne(Moderator::class, ['memberID' => 'Moderator_id']);
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
