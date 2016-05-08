<?php
/**
 * CHttpRequest переопределен для загрузки файлов через ajax, подробнее:
 * http://www.yiiframework.com/forum/index.php/topic/8689-disable-csrf-verification-per-controller-action/
 *
 * @category CoreComponents
 * @package  core.modules.core.components
 * @author   AKulikov <tuxuls@gmail.com>
 * @license  BSD https://raw.github.com/core/core/master/LICENSE
 * @version  0.9.4
 * @link     http://websum.uz
 **/

namespace core\components;

use CHttpRequest;
use CHttpException;
use Yii;

/**
 * Class HttpRequest
 * @package core\components
 */
class HttpRequest extends CHttpRequest
{
    /**
     * @var array
     */
    public $noCsrfValidationRoutes = [];

    protected function normalizeRequest()
    {
        parent::normalizeRequest();

        if ($this->enableCsrfValidation && !empty($this->noCsrfValidationRoutes)) {
            // for fixing csrf validation disabling

            try {
                $url = Yii::app()->getUrlManager()->parseUrl($this);
            } catch (CHttpException $e) {
                return false;
            }

            foreach ($this->noCsrfValidationRoutes as $route) {
                if (strpos($url, trim($route, '/')) === 0) {
                    Yii::app()->detachEventHandler('onBeginRequest', [$this, 'validateCsrfToken']);
                }
            }
        }
    }

    /**
     * @param  null $urlIfNull
     * @return null
     */
    public function urlReferer($urlIfNull = null)
    {
        return isset($_SERVER['HTTP_REFERER'])
            ? $_SERVER['HTTP_REFERER']
            : $urlIfNull;
    }
}
