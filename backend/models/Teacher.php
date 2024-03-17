<?php

namespace backend\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "teacher".
 *
 * @property int $memberID
 * @property string $qualification
 * @property string $speciality
 * @property string $experience
 *
 * @property CourseTeacher[] $courseTeachers
 * @property User $member
 * @property QuestionSet[] $questionSets
 * @property StudentJoinRequests[] $studentJoinRequests
 * @property TeacherApprovalRequests[] $teacherApprovalRequests
 */
class Teacher extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'teacher';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['memberID', 'qualification', 'speciality', 'experience'], 'required'],
            [['memberID'], 'integer'],
            [['qualification', 'speciality', 'experience'], 'string', 'max' => 45],
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
            'qualification' => 'Qualification',
            'speciality' => 'Speciality',
            'experience' => 'Experience',
        ];
    }

    /**
     * Gets query for [[CourseTeachers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourseTeachers()
    {
        return $this->hasMany(CourseTeacher::class, ['Teacher_id' => 'memberID']);
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
     * Gets query for [[QuestionSets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionSets()
    {
        return $this->hasMany(QuestionSet::class, ['created_by' => 'memberID']);
    }

    /**
     * Gets query for [[StudentJoinRequests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentJoinRequests()
    {
        return $this->hasMany(StudentJoinRequests::class, ['teacher_id' => 'memberID']);
    }

    /**
     * Gets query for [[TeacherApprovalRequests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTeacherApprovalRequests()
    {
        return $this->hasMany(TeacherApprovalRequests::class, ['teacher_id' => 'memberID']);
    }
}
