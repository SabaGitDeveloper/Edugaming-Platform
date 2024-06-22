<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "options_puzzle".
 *
 * @property int $optionID
 * @property int|null $questionNo
 * @property string|null $option_text
 * @property int|null $sequence_number
 * @property int|null $display_number
 *
 * @property Questions $questionNo0
 */
class OptionsPuzzle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'options_puzzle';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['optionID'], 'required'],
            [['optionID', 'questionNo', 'sequence_number', 'display_number'], 'integer'],
            [['option_text'], 'string'],
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
            'sequence_number' => 'Sequence Number',
            'display_number' => 'Display Number',
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
