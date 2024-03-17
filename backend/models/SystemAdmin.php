<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "system_admin".
 *
 * @property int $memberID
 *
 * @property User $member
 * @property ModeratorApprovalRequests[] $moderatorApprovalRequests
 */
class SystemAdmin extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'system_admin';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['memberID'], 'required'],
            [['memberID'], 'integer'],
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
        ];
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
        return $this->hasMany(ModeratorApprovalRequests::class, ['admin_id' => 'memberID']);
    }
}
