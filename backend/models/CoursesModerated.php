<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "courses_moderated".
 *
 * @property int $idCourses_Moderated
 * @property string $course_id
 * @property int $moderator_id
 *
 * @property Courses $course
 * @property Moderator $moderator
 */
class CoursesModerated extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'courses_moderated';
    }

    /**
     * {@inheritdoc}
     */
    // [['idCourses_Moderated', 'course_id', 'moderator_id'], 'required'],
    public function rules()
    {
        return [
           
            [['idCourses_Moderated', 'moderator_id'], 'integer'],
            [['course_id'], 'string', 'max' => 10],
            [['idCourses_Moderated'], 'unique'],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Courses::class, 'targetAttribute' => ['course_id' => 'course_code']],
            [['moderator_id'], 'exist', 'skipOnError' => true, 'targetClass' => Moderator::class, 'targetAttribute' => ['moderator_id' => 'memberID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idCourses_Moderated' => 'Id Courses Moderated',
            'course_id' => 'Course ID',
            'moderator_id' => 'Moderator ID',
        ];
    }

    /**
     * Gets query for [[Course]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Courses::class, ['course_code' => 'course_id']);
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
