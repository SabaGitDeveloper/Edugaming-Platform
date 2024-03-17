<?php

namespace backend\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "moderator".
 *
 * @property int $memberID
 * @property int $pending_questionset_number
 *
 * @property CoursesModerated[] $coursesModerateds
 * @property User $member
 * @property ModeratorApprovalRequests[] $moderatorApprovalRequests
 * @property TeacherApprovalRequests[] $teacherApprovalRequests
 */
class Moderator extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'moderator';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['memberID', 'pending_questionset_number'], 'required'],
            [['memberID', 'pending_questionset_number'], 'integer'],
            [['memberID'], 'unique'],
            [['memberID'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['memberID' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'memberID' => 'Member ID',
            'pending_questionset_number' => 'Pending Questionset Number',
        ];
    }

    /**
     * Gets query for [[CoursesModerateds]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCoursesModerateds()
    {
        return $this->hasMany(CoursesModerated::class, ['moderator_id' => 'memberID']);
    }

    /**
     * Gets query for [[Member]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMember()
    {
        return $this->hasOne(User::class, ['id' => 'memberID']);
    }

    /**
     * Gets query for [[ModeratorApprovalRequests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getModeratorApprovalRequests()
    {
        return $this->hasMany(ModeratorApprovalRequests::class, ['moderator_id' => 'memberID']);
    }

    /**
     * Gets query for [[TeacherApprovalRequests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTeacherApprovalRequests()
    {
        return $this->hasMany(TeacherApprovalRequests::class, ['Moderator_id' => 'memberID']);
    }
}
