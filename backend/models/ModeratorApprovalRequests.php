<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "moderator_approval_requests".
 *
 * @property int $idModerator_Approval_Requests
 * @property int $moderator_id
 * @property int $admin_id
 * @property string $status
 *
 * @property SystemAdmin $admin
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
    public function rules()
    {
        return [
            [['idModerator_Approval_Requests', 'moderator_id', 'admin_id', 'status'], 'required'],
            [['idModerator_Approval_Requests', 'moderator_id', 'admin_id'], 'integer'],
            [['status'], 'string', 'max' => 1],
            [['idModerator_Approval_Requests'], 'unique'],
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
     * Gets query for [[Moderator]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getModerator()
    {
        return $this->hasOne(Moderator::class, ['memberID' => 'moderator_id']);
    }
}
