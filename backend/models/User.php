<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string|null $verification_token
 * @property int|null $role
 * @property int|null $active
 *
 * @property RequestUpdateHistory[] $requestUpdateHistories
 */
class User extends \yii\db\ActiveRecord
{
    const ROLE_ADMIN = 1;
    const ROLE_MANAGER = 2;

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;

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
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at', 'role', 'active'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'verification_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            ['role', 'default', 'value' => self::ROLE_MANAGER],
            ['role', 'in', 'range' => [self::ROLE_ADMIN, self::ROLE_MANAGER]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'verification_token' => 'Verification Token',
            'role' => 'Role',
            'active' => 'Active',
        ];
    }

    /**
     * Gets query for [[RequestUpdateHistories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequestUpdateHistories()
    {
        return $this->hasMany(RequestUpdateHistory::class, ['user_id' => 'id']);
    }

    public static function getUserRoles()
    {
        return [
            self::ROLE_ADMIN => 'Admin',
            self::ROLE_MANAGER => 'Manager',
        ];
    }

    public static function getUserStatuses()
    {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_INACTIVE => 'Inactive',
        ];
    }

    public function getUserRole()
    {
        return $this::getUserRoles()[$this->role];
    }

    public function getUserStatus()
    {
        return $this::getUserStatuses()[$this->active];
    }
}
