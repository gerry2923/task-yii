<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string|null $user_register_date
 * @property string $user_name
 * @property string $user_password
 * @property string|null $user_avatar
 * @property string|null $user_birthday
 * @property string $user_email
 * @property string $user_phone
 * @property string|null $user_telegramm
 * @property string|null $user_info
 * @property int|null $user_role_id
 * @property int $user_city_id
 *
 * @property Specialization[] $specializations
 * @property Tasks[] $tasks
 * @property Cities $userCity
 * @property Roles $userRole
 * @property UsersSpecialization[] $usersSpecializations
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_register_date', 'user_birthday'], 'safe'],
            [['user_name', 'user_password', 'user_email', 'user_phone', 'user_city_id'], 'required'],
            [['user_role_id', 'user_city_id'], 'integer'],
            [['user_name', 'user_avatar', 'user_email', 'user_phone', 'user_telegramm', 'user_info'], 'string', 'max' => 128],
            [['user_password'], 'string', 'max' => 256],
            [['user_role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Roles::class, 'targetAttribute' => ['user_role_id' => 'id']],
            [['user_city_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::class, 'targetAttribute' => ['user_city_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_register_date' => 'User Register Date',
            'user_name' => 'User Name',
            'user_password' => 'User Password',
            'user_avatar' => 'User Avatar',
            'user_birthday' => 'User Birthday',
            'user_email' => 'User Email',
            'user_phone' => 'User Phone',
            'user_telegramm' => 'User Telegramm',
            'user_info' => 'User Info',
            'user_role_id' => 'User Role ID',
            'user_city_id' => 'User City ID',
        ];
    }

    /**
     * Gets query for [[Specializations]].
     *
     * @return \yii\db\ActiveQuery|SpecializationQuery
     */
    public function getSpecializations()
    {
        return $this->hasMany(Specialization::class, ['id' => 'specialization_id'])->viaTable('users_specialization', ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery|TasksQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Tasks::class, ['task_user_id' => 'id']);
    }

    /**
     * Gets query for [[UserCity]].
     *
     * @return \yii\db\ActiveQuery|CitiesQuery
     */
    public function getUserCity()
    {
        return $this->hasOne(Cities::class, ['id' => 'user_city_id']);
    }

    /**
     * Gets query for [[UserRole]].
     *
     * @return \yii\db\ActiveQuery|RolesQuery
     */
    public function getUserRole()
    {
        return $this->hasOne(Roles::class, ['id' => 'user_role_id']);
    }

    /**
     * Gets query for [[UsersSpecializations]].
     *
     * @return \yii\db\ActiveQuery|UsersSpecializationQuery
     */
    public function getUsersSpecializations()
    {
        return $this->hasMany(UsersSpecialization::class, ['user_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return UsersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsersQuery(get_called_class());
    }
}
