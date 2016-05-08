<?php

/**
 * Валидатор уникальности поля типа slug или alias
 *
 * @author Kucherov Anton <idexter.ru@gmail.com>
 * @link http://websum.uz
 * @copyright 2009-2013 amyLabs && Websum team
 * @package core.modules.core.components.validators
 * @since 0.1
 *
 */
namespace core\components\validators;

use CUniqueValidator;

class YUniqueSlugValidator extends CUniqueValidator
{
    protected function validateAttribute($object, $attribute)
    {
        $this->criteria = ['condition' => 'lang = :lang', 'params' => [':lang' => $object->lang]];

        return parent::validateAttribute($object, $attribute);
    }
}
