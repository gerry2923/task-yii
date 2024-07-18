<?php
namespace TaskYii\controllers;
use TaskYii\models\User;
use yii\web\Controller;

class UserController extends Controller
{
  public function actionIndex()
  {
    // $user = new User();
    // $user->name = "Петров Иван";
    // $user->phone = "79005552211";
    // $user->email = "petro.ivan@mail.ru";
    // $user->position = "Менеджер";
    // // сохранение модели в базе данных
    // $user->save();


    $user = User::findAll(['user_email'=> 'pavlo.greg.54@mail.ru']);
    return $this->render('index', $user);
  }
}