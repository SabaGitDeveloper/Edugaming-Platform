<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "gameinterfaceresource".
 *
 * @property int $idGameInterfaceResource
 * @property int $Resource_id
 * @property int $Interface_id
 *
 * @property Gameinterfaces $interface
 */
class GameInterfaceResource extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gameinterfaceresource';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Resource_id', 'Interface_id'], 'required'],
            [['Resource_id', 'Interface_id'], 'integer'],
            [['Interface_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gameinterfaces::class, 'targetAttribute' => ['Interface_id' => 'idGameInterfaces']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idGameInterfaceResource' => 'Id Game Interface Resource',
            'Resource_id' => 'Resource ID',
            'Interface_id' => 'Interface ID',
        ];
    }

    /**
     * Gets query for [[Interface]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInterface()
    {
        return $this->hasOne(Gameinterfaces::class, ['idGameInterfaces' => 'Interface_id']);
    }
}
