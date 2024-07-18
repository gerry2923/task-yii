<?php

namespace TaskYii;

class CompleteAction extends AbstractAction 
{
  public static function getLabel(): string
  {
    return "Завершить";
  }

  public static function getInternalName(): string
  {
    return "act_complete";
  }

  public static function checkRights($userId, $peformerId, $clientId): bool
  {
    return $userId == $clientId;
  }
}