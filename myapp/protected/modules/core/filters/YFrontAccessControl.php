<?php
/**
 * YFrontAccessControl фильтр, контроллирующий доступ к публичной части сайта
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
use Yii;

class YFrontAccessControl extends CAccessControlFilter
{
    public function preFilter($filterChain)
    {
        if (Yii::app()->getUser()->isAuthenticated()) {
            return true;
        }

        Yii::app()->getUser()->setReturnUrl(Yii::app()->getRequest()->getUrl());

        $filterChain->controller->redirect(['/user/account/login']);
    }
}
