<?php
namespace core\events;

use core\components\Event;

/**
 * Class CoreBeforeBackendControllerActionEvent
 * @package core\events
 */
class CoreControllerInitEvent extends Event
{
    /**
     * @var
     */
    protected $controller;

    /**
     * @var
     */
    protected $user;

    /**
     * @param \Controller $controller
     * @param \IWebUser $user
     */
    public function __construct(\CController $controller, \IWebUser $user)
    {
        $this->controller = $controller;
        $this->user = $user;

    }

    /**
     * @param mixed $controller
     */
    public function setController($controller)
    {
        $this->controller = $controller;
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }
}
