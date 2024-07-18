<?php

namespace TaskYii;

class RespondAction extends AbstractAction
{

  public static function getLabel(): string
  {
    return "откликнуться";
  }

  public static function getInternalName(): string
  {
    return "act_respond";
  }

  public static function checkRights($userId, $peformerId, $clientId):bool
  {
    return $userId == $peformerId;
  }

}