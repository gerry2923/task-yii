<?php

namespace TaskYii;

class DenyAction extends AbstractAction
{
  public static function getLabel():string
  {
    return "отказаться";
  } 

  public static function getInternalName():string
  {
    return "act_deny";
  }

  public static function checkRights($userId, $peformerId, $clientId):bool
  {
    return $userId == $peformerId;
  }
}