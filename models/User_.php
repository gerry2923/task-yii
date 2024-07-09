<?php
namespace TaskYii\models;
use  yii\db\ActiveRecord;

class User extends ActiveRecord
{
  public static function tableName()
  {
    return 'users';
  }
  
  public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'phone' => 'Телефон',
            'email' => 'Электронная почта',
            'position' => 'Должность'
        ];
    }

}