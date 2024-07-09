<?php

namespace TaskYii;

class CancelAction extends  AbstractAction
{
  public static function getLabel() : string
  {
    return "Отменить";
  }

  public static function getInternalName():string
  {
    return "act_cancel";
  }

  public static function checkRights($userId, $peformerId, $clientId) : bool
  {
    return $userId == $clientId;
    
  }
}