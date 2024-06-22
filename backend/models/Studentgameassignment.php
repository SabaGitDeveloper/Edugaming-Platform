<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "studentgameassignment".
 *
 * @property int $idStudentGameAssignment
 * @property int $Accuracy
 * @property int $Speed
 * @property int $tries
 * @property string $CourseID
 * @property int $StudentID
 * @property int $AssignmentId
 *
 * @property GameAssignments $assignment
 * @property Courses $course
 * @property Student $student
 */
class Studentgameassignment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'studentgameassignment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idStudentGameAssignment','Accuracy', 'Speed', 'tries', 'CourseID', 'StudentID', 'AssignmentId'], 'required'],
            [['idStudentGameAssignment','Accuracy', 'Speed', 'tries', 'StudentID', 'AssignmentId'], 'integer'],
            [['CourseID'], 'string', 'max' => 10],
            [['idStudentGameAssignment'], 'unique'],
            [['StudentID'], 'exist', 'skipOnError' => true, 'targetClass' => Student::class, 'targetAttribute' => ['StudentID' => 'memberID']],
            [['CourseID'], 'exist', 'skipOnError' => true, 'targetClass' => Courses::class, 'targetAttribute' => ['CourseID' => 'course_code']],
            [['AssignmentId'], 'exist', 'skipOnError' => true, 'targetClass' => GameAssignments::class, 'targetAttribute' => ['AssignmentId' => 'assignmentID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idStudentGameAssignment' => 'Id Student Game Assignment',
            'Accuracy' => 'Accuracy',
            'Speed' => 'Speed',
            'tries' => 'Tries',
            'CourseID' => 'Course ID',
            'StudentID' => 'Student ID',
            'AssignmentId' => 'Assignment ID',
        ];
    }

    /**
     * Gets query for [[Assignment]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAssignment()
    {
        return $this->hasOne(GameAssignments::class, ['assignmentID' => 'AssignmentId']);
    }

    /**
     * Gets query for [[Course]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Courses::class, ['course_code' => 'CourseID']);
    }

    /**
     * Gets query for [[Student]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Student::class, ['memberID' => 'StudentID']);
    }
}
