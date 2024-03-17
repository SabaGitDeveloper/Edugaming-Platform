<?php

namespace backend\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "student".
 *
 * @property int $memberID
 *
 * @property User $member
 * @property StudentJoinRequests[] $studentJoinRequests
 * @property Studentcourseenrollment[] $studentcourseenrollments
 * @property Studentgameassignment[] $studentgameassignments
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'student';
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
     * Gets query for [[StudentJoinRequests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentJoinRequests()
    {
        return $this->hasMany(StudentJoinRequests::class, ['student_id' => 'memberID']);
    }

    /**
     * Gets query for [[Studentcourseenrollments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentcourseenrollments()
    {
        return $this->hasMany(Studentcourseenrollment::class, ['Student_ID' => 'memberID']);
    }

    /**
     * Gets query for [[Studentgameassignments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentgameassignments()
    {
        return $this->hasMany(Studentgameassignment::class, ['StudentID' => 'memberID']);
    }
}
