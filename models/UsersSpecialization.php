<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users_specialization".
 *
 * @property int $user_id
 * @property int $specialization_id
 *
 * @property Specialization $specialization
 * @property Users $user
 */
class UsersSpecialization extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users_specialization';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'specialization_id'], 'required'],
            [['user_id', 'specialization_id'], 'integer'],
            [['user_id', 'specialization_id'], 'unique', 'targetAttribute' => ['user_id', 'specialization_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['user_id' => 'id']],
            [['specialization_id'], 'exist', 'skipOnError' => true, 'targetClass' => Specialization::class, 'targetAttribute' => ['specialization_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'specialization_id' => 'Specialization ID',
        ];
    }

    /**
     * Gets query for [[Specialization]].
     *
     * @return \yii\db\ActiveQuery|SpecializationQuery
     */
    public function getSpecialization()
    {
        return $this->hasOne(Specialization::class, ['id' => 'specialization_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|UsersQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return UsersSpecializationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsersSpecializationQuery(get_called_class());
    }
}
