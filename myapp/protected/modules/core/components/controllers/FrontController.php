<?php
/**
 * Базовый класс для всех контроллеров публичной части
 *
 * @category CoreComponents
 * @package  core.modules.core.components.controllers
 * @author   CoreTeam <team@websum.uz>
 * @license  BSD https://raw.github.com/core/core/master/LICENSE
 * @version  0.6
 * @link     http://websum.uz
 **/

namespace core\components\controllers;

use Yii;
use core\events\CoreControllerInitEvent;
use core\events\CoreEvents;
use application\components\Controller;

/**
 * Class FrontController
 * @package core\components\controllers
 */
abstract class FrontController extends Controller
{
    /**
     * Вызывается при инициализации FrontController
     * Присваивает значения, необходимым переменным
     */
    
    public function init()
    {
        if(Yii::app()->getUser()->isAuthenticated() && Yii::app()->getUser()->getProfile()->session_user != Yii::app()->getUser()->getState('token_line')){
            Yii::app()->getUser()->logout();

            $this->redirect(
                ['/user/account/login']
            );
        }
        
        Yii::app()->CoreAjaxWidget->run($this);
        
        Yii::app()->eventManager->fire(CoreEvents::BEFORE_FRONT_CONTROLLER_INIT, new CoreControllerInitEvent($this, Yii::app()->getUser()));

        parent::init();

        Yii::app()->theme = $this->core->theme ?: 'default';

        $bootstrap = Yii::app()->getTheme()->getBasePath() . DIRECTORY_SEPARATOR . "bootstrap.php";

       
        
        if (is_file($bootstrap)) {
            require $bootstrap;
        }
        
    }
    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'core\components\actions\YCaptchaAction',
                'backColor' => 0xFFFFFF,
                'testLimit' => 1,
                'minLength' => Yii::app()->getModule('user')->minCaptchaLength,
            ],
            'widget' => [
                'class' => 'application.modules.user.widgets.LoginWidget'
            ]
        ];
    }
    
    protected function isActiveAccount()
    {
        if(strtotime(Yii::app()->getUser()->getProfile()->active_date) < strtotime(date('Y-m-d')))
        {
            return true;
        } else {
            return false;
        }   
    }
    
}
