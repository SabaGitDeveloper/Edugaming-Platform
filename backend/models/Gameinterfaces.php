<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "gameinterfaces".
 *
 * @property int $idGameInterfaces
 * @property string $GameInterfaceDes
 * @property string $InterfaceType
 *
 * @property Gameinterfaceresource[] $gameinterfaceresources
 */
class Gameinterfaces extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gameinterfaces';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['GameInterfaceDes', 'InterfaceType'], 'required'],
            [['GameInterfaceDes', 'InterfaceType'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idGameInterfaces' => 'Id Game Interfaces',
            'GameInterfaceDes' => 'Game Interface Des',
            'InterfaceType' => 'Interface Type',
        ];
    }

    /**
     * Gets query for [[Gameinterfaceresources]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGameinterfaceresources()
    {
        return $this->hasMany(Gameinterfaceresource::class, ['Interface_id' => 'idGameInterfaces']);
    }
}
