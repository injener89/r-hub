<?php
/**
 * Валидатор поля типа slug или alias
 *
 * @author core team <team@websum.uz>
 * @link http://websum.uz
 * @copyright 2009-2013 amyLabs && Websum team
 * @package core.modules.core.components.validators
 * @since 0.1
 *
 */
namespace core\components\validators;

use CValidator;
use Yii;

class YSLugValidator extends CValidator
{
    public function validateAttribute($object, $attribute)
    {
        $value = $object->$attribute;

        if (preg_match('/[^a-zA-Z0-9_\-]/', $value)) {
            $message = ($this->message !== null)
                ? $this->message
                : Yii::t('CoreModule.core', '{attribute} have illegal characters');
            $this->addError($object, $attribute, $message);
        }
    }
}
