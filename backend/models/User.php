<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $email
 * @property string $username
 * @property string|null $password
 * @property string|null $is_student
 * @property string|null $is_teacher
 * @property string|null $is_moderator
 * @property string|null $is_system_admin
 * @property string|null $is_design_admin
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string|null $verification_token
 * @property int $status
 * @property string $updated_at
 * @property string|null $created_at
 *
 * @property Moderator $moderator
 * @property Student $student
 * @property SystemAdmin $systemAdmin
 * @property Teacher $teacher
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'username', 'auth_key', 'password_hash', 'status', 'updated_at'], 'required'],
            [['status'], 'integer'],
            [['created_at'], 'safe'],
            [['email', 'username', 'password', 'updated_at'], 'string', 'max' => 45],
            [['is_student', 'is_teacher', 'is_moderator', 'is_system_admin', 'is_design_admin'], 'string', 'max' => 1],
            [['auth_key'], 'string', 'max' => 32],
            [['password_hash', 'password_reset_token', 'verification_token'], 'string', 'max' => 255],
            [['email'], 'unique'],
            [['username'], 'unique'],
            [['password'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'username' => 'Username',
            'password' => 'Password',
            'is_student' => 'Is Student',
            'is_teacher' => 'Is Teacher',
            'is_moderator' => 'Is Moderator',
            'is_system_admin' => 'Is System Admin',
            'is_design_admin' => 'Is Design Admin',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'verification_token' => 'Verification Token',
            'status' => 'Status',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Moderator]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getModerator()
    {
        return $this->hasOne(Moderator::class, ['memberID' => 'id']);
    }

    /**
     * Gets query for [[Student]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Student::class, ['memberID' => 'id']);
    }

    /**
     * Gets query for [[SystemAdmin]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSystemAdmin()
    {
        return $this->hasOne(SystemAdmin::class, ['memberID' => 'id']);
    }

    /**
     * Gets query for [[Teacher]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTeacher()
    {
        return $this->hasOne(Teacher::class, ['memberID' => 'id']);
    }
}
