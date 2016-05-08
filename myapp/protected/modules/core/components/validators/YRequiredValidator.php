<?php
/**
 * Валидатор заполненности поля
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

class YRequiredValidator extends CValidator
{
    public $requiredValue;
    public $strict = false;
    public $allowEmpty = false;

    public function validateAttribute($object, $attribute)
    {
        
        $value = $object->$attribute;
        
        if ($this->allowEmpty && $this->isEmpty($value)) {
            return;
        }
        if ($this->requiredValue !== null) {
            if (!$this->strict && $value != $this->requiredValue || $this->strict && $value !== $this->requiredValue) {
                $message = ($this->message !== null)
                    ? $this->message
                    : Yii::t(
                        'CoreModule.core',
                        '{attribute} must be {value}',
                        ['{value}' => $this->requiredValue]
                    );

                $this->addError($object, $attribute, $message);
            }
        } elseif ($this->isEmpty($value, true)) {
            $message = ($this->message !== null)
                ? $this->message
                : Yii::t('CoreModule.core', '{attribute} cannot be blank');

            $this->addError($object, $attribute, $message);
        }
    }
}
