<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "specialization".
 *
 * @property int $id
 * @property string $specialization_name
 *
 * @property Users[] $users
 * @property UsersSpecialization[] $usersSpecializations
 */
class Specialization extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'specialization';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['specialization_name'], 'required'],
            [['specialization_name'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'specialization_name' => 'Specialization Name',
        ];
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery|UsersQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::class, ['id' => 'user_id'])->viaTable('users_specialization', ['specialization_id' => 'id']);
    }

    /**
     * Gets query for [[UsersSpecializations]].
     *
     * @return \yii\db\ActiveQuery|UsersSpecializationQuery
     */
    public function getUsersSpecializations()
    {
        return $this->hasMany(UsersSpecialization::class, ['specialization_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return SpecializationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SpecializationQuery(get_called_class());
    }
}
