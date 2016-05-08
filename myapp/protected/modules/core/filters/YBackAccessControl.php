<?php
/**
 * YBackAccessControl фильтр, контролирующий доступ в панель управления
 *
 * @author core team <team@websum.uz>
 * @link http://websum.uz
 * @copyright 2009-2013 amyLabs && Websum team
 * @package core.modules.user.filters
 * @since 0.1
 *
 */
namespace core\filters;

use CAccessControlFilter;
use CHttpException;
use Yii;
use core\components\WebModule;

class YBackAccessControl extends CAccessControlFilter
{
    public function preFilter($filterChain)
    {
        
        $ips = $filterChain->controller->core->getAllowedIp();

        if (!empty($ips) && !in_array(Yii::app()->getRequest()->getUserHostAddress(), $ips)) {
            throw new CHttpException(404);
        }

        Yii::app()->getUser()->loginUrl = ['/user/account/backendlogin'];

        if (Yii::app()->getUser()->isGuest) {
            if ($filterChain->controller->core->hidePanelUrls == WebModule::CHOICE_YES) {
                throw new CHttpException(404);
            }
            Yii::app()->getUser()->setReturnUrl(Yii::app()->getRequest()->getUrl());
            $filterChain->controller->redirect(['/user/account/backendlogin']);
        }

        if (Yii::app()->getUser()->isSuperUser()) {
            
            return true;
        }

        // если пользователь авторизован, но не администратор, перекинем его на страницу для разлогиневшегося пользователя
        $filterChain->controller->redirect(Yii::app()->createAbsoluteUrl(Yii::app()->getModule('user')->logoutSuccess));
        
    }
}
