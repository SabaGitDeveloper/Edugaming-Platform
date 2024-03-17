<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "gameresource".
 *
 * @property int $idGameResource
 * @property string $Resource_data
 * @property string $ResourceFile
 */
class Gameresource extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gameresource';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Resource_data', 'ResourceFile'], 'required'],
            [['Resource_data', 'ResourceFile'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idGameResource' => 'Id Game Resource',
            'Resource_data' => 'Resource Data',
            'ResourceFile' => 'Resource File',
        ];
    }
}
