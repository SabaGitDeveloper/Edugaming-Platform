<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "options".
 *
 * @property int $optionID
 * @property int|null $questionNo
 * @property string|null $option_text
 * @property string $option_type
 *
 * @property Questions $questionNo0
 */
class Options extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'options';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['optionID'], 'required'],
            [['optionID', 'questionNo'], 'integer'],
            [['option_text', 'option_type'], 'string'],
            [['optionID'], 'unique'],
            [['questionNo'], 'exist', 'skipOnError' => true, 'targetClass' => Questions::class, 'targetAttribute' => ['questionNo' => 'QuestionNo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'optionID' => 'Option ID',
            'questionNo' => 'Question No',
            'option_text' => 'Option Text',
            'option_type' => 'Option Type',
        ];
    }

    /**
     * Gets query for [[QuestionNo0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionNo0()
    {
        return $this->hasOne(Questions::class, ['QuestionNo' => 'questionNo']);
    }
}
