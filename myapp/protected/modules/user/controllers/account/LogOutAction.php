<?php
/**
 * Экшн, отвечающий за разлогинивание пользователя
 *
 * @category CoreComponents
 * @package  core.modules.user.controllers.account
 * @author   CoreTeam <team@websum.uz>
 * @license  BSD http://ru.wikipedia.org/wiki/%D0%9B%D0%B8%D1%86%D0%B5%D0%BD%D0%B7%D0%B8%D1%8F_BSD
 * @version  0.7
 * @link     http://websum.uz
 *
 **/
use core\helpers\Url;

class LogOutAction extends CAction
{
    public function run()
    {
        Yii::app()->authenticationManager->logout(Yii::app()->getUser());

        $this->getController()->redirect(Url::redirectUrl(Yii::app()->getModule('user')->logoutSuccess));
    }
}