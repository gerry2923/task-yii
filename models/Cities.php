<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cities".
 *
 * @property int $id
 * @property string $city_name
 * @property string|null $city_lat
 * @property string|null $city_long
 *
 * @property Tasks[] $tasks
 * @property Users[] $users
 */
class Cities extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cities';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['city_name'], 'required'],
            [['city_name', 'city_lat', 'city_long'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'city_name' => 'City Name',
            'city_lat' => 'City Lat',
            'city_long' => 'City Long',
        ];
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery|UsersQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Tasks::class, ['task_locale_id' => 'id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery|UsersQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::class, ['user_city_id' => 'id']);
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
