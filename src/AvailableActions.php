<?php

namespace TaskYii;

use StatusActionException;

class AvailableActions {
  
  const STATUS_NEW = 'new';
  const STATUS_IN_PROGRESS = 'in_progress';
  const STATUS_CANCEL = 'cancel';
  const STATUS_COMPLETE = 'complete';
  const STATUS_EXPIRED = 'expired';

  const ACTION_CANCEL = "act_cancel";
  const ACTION_RESPOND = "act_respond";
  const ACTION_DENY = "act_deny";
  const ACTION_COMPLETE = "act_complete";

  const ROLE_PERFORMER = "performer";
  const ROLE_CLIENT = "client";

  private ?int $client_id;
  private ?int $performer_id;
  private ?string $current_status;

  public function __construct( int $client_id, ?int $performer_id, $current_status="new" )
  {
    $this->client_id = $client_id;
    $this->performer_id = $performer_id;

    $this->setStatus($current_status);
  
  }
/**
 * устанавливает новый статус для задания
 * @param $new_status
 * 
 */
  private function setStatus($new_status):void
  {
    $available_statuses = [self::STATUS_CANCEL, self::STATUS_COMPLETE, self::STATUS_EXPIRED, self::STATUS_IN_PROGRESS, self::STATUS_NEW];


    if(!in_array( $new_status, $available_statuses ))
    {
      throw new StatusActionException("Неизвестный статус: " . $new_status);
    }

    $this->current_status = $new_status;
  }

/**
 * проверяет есть ли такая роль в списке ролей
 * @param $role - роль
 * 
 */

  public function checkRole(string $role) : void
  {
    $available_roles = [self::ROLE_CLIENT , self::ROLE_PERFORMER];

    if(!in_array($role, $available_roles))
    {
      throw new StatusActionException("Неизвестная роль: " . $role);
    }

  }

  /**
   * возвращает текущий статус задания
   * @return string
   */

  public function getStatus() : string
  {
    return $this->current_status; 
  }
  
  
  /**
   * определять список доступных действий втекущем статусе
   * т.е. что можно сделать с заданием
   * @param $status
   * $return array|null
   */
  public function statusAllowedActions() : array
  {
    $actionsByStatues = [ self::STATUS_NEW => [CancelAction::class, RespondAction::class],
                          self::STATUS_IN_PROGRESS => [CompleteAction::class, DenyAction::class],
                          self::STATUS_CANCEL => [],
                          self::STATUS_COMPLETE => [],
                          self::STATUS_EXPIRED => []];

    return $actionsByStatues;
  }

 
  /**
   * 
   * определяет новый статус после выполнения определенного действия
   * @param $action
   * @return string|null
   */
  public function getNextStatus($action) : ?string
  {
    $new_statuses_by_actions = [self::ACTION_CANCEL => self::STATUS_CANCEL,
                                self::ACTION_RESPOND => self::STATUS_IN_PROGRESS,
                                self::ACTION_COMPLETE => self::STATUS_COMPLETE,
                                self::ACTION_DENY => self::STATUS_EXPIRED];

    return $new_statuses_by_actions[$action] ?? '';
  }

/**
 * 
 * возвращает карту статусов всех заданий
 * 
 * @return array
 */

  public function getStatusMap() : array
  {
    $map = [
      self::STATUS_CANCEL => 'отменено', 
      self::STATUS_COMPLETE => 'выполнено',
      self::STATUS_EXPIRED => 'провалено', 
      self::STATUS_IN_PROGRESS => 'в работе',
      self::STATUS_NEW => 'новое'
    ];

    return $map;
  }

/**
 * 
 * возвращает карту всех действий
 * @return array
 * 
 */

  public function getActionMap() : array
  {
    $map = [
      self::ACTION_CANCEL => 'отменить',
      self::ACTION_COMPLETE => 'завершить',
      self::ACTION_DENY => 'отказаться',
      self::ACTION_RESPOND => 'откликнуться'
    ];

    return $map;
  }

/**
 * @param $role
 * @return  array
 */

  public function roleAllowedActions()
  {
    $acitonByRole = [ self::ROLE_PERFORMER => [RespondAction::class, DenyAction::class],
                      self::ROLE_CLIENT => [CancelAction::class, CompleteAction::class]];

    return $acitonByRole;
  }


/**
 * возвращает действие, которое может сделать пользователь в зависимости от своей роли и статуса задания
 * 
 * @param $role - роль клиента
 * @param $id - идентификационный номер клиента
 * @return array  - список действий (по факту одно действие)
 * 
 */
  public function getAvailibleActions(string $role, int $id) : array
  {

    $roleActions  = $this->roleAllowedActions()[$role];

    $statusdActions = $this->statusAllowedActions()[$this->current_status];

    $allowedActions = array_intersect($roleActions, $statusdActions);

    // обходит каждое значение массива и передает его в анонимную функцию
    // выполняет с ней какие-то действия и записывает в новый массив, если 
    // действие выполнилось, т.е. true
    $allowedActions = array_filter($allowedActions, function ($action) use ($id) {
                                    return $action::checkRights($id,  $this->performer_id, $this->client_id);
                                  });

    // возвращает все значения массива
    return array_values($allowedActions);
  }
}