<?php

/**
 * Yii Extended Captcha
 * Класс реализующий Капчу, параметры длинны которой извлекаются
 * из настроек модуля.
 *
 * @category CoreComponents
 * @package  core.modules.core.components.actions
 * @author   Anton Kucherov <idexter.ru@gmail.com>
 * @license  BSD https://raw.github.com/core/core/master/LICENSE
 * @version  0.1
 * @link     http://websum.uz
 **/
namespace core\components\actions;

use CCaptchaAction;

/**
 * Class YCaptchaAction
 * @package core\components\actions
 */
class YCaptchaAction extends CCaptchaAction
{
    /**
     * @var int|mixed
     */
    public $minLength = 3;
    /**
     * @var int|mixed
     */
    public $maxLength = 6;

    /**
     * @param \CController $controller
     * @param string $id
     */
    public function __construct($controller, $id)
    {
        parent::__construct($controller, $id);

        $module = $controller->getModule();

        if ($module && property_exists($module, "minCaptchaLength")) {
            $this->minLength = $module->minCaptchaLength;
        }
        if ($module && property_exists($module, "maxCaptchaLength")) {
            $this->maxLength = $module->maxCaptchaLength;
        }
    }

}
