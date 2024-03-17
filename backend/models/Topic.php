<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "topic".
 *
 * @property int $topicID
 * @property string $topic_title
 * @property string $topic_description
 * @property string $learning_target
 * @property int|null $parent_id
 * @property int|null $has_children
 * @property string|null $course_code
 *
 * @property Courses $courseCode
 * @property QuestionSet[] $questionSets
 */
class Topic extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'topic';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['topic_title', 'topic_description', 'learning_target'], 'required'],
            [['topic_description', 'learning_target'], 'string'],
            [['parent_id', 'has_children'], 'integer'],
            [['topic_title'], 'string', 'max' => 45],
            [['course_code'], 'string', 'max' => 10],
            [['topic_title'], 'unique'],
            [['course_code'], 'exist', 'skipOnError' => true, 'targetClass' => Courses::class, 'targetAttribute' => ['course_code' => 'course_code']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'topicID' => 'Topic ID',
            'topic_title' => 'Topic Title',
            'topic_description' => 'Topic Description',
            'learning_target' => 'Learning Target',
            'parent_id' => 'Parent ID',
            'has_children' => 'Has Children',
            'course_code' => 'Course Code',
        ];
    }

    /**
     * Gets query for [[CourseCode]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourseCode()
    {
        return $this->hasOne(Courses::class, ['course_code' => 'course_code']);
    }

    /**
     * Gets query for [[QuestionSets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionSets()
    {
        return $this->hasMany(QuestionSet::class, ['topicID' => 'topicID']);
    }
}
