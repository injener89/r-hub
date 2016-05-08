<?php
/**
 * core\models\YFormModel - базовый класс для всех form-моделей
 *
 * Все модели, разработанные для должны наследовать этот класс.
 *
 * @package  core.modules.core.models
 * @abstract
 * @author core team
 * @version 0.0.3
 * @link http://websum.uz - основной сайт
 *
 */

namespace core\models;

use CFormModel;

abstract class YFormModel extends CFormModel
{
    public function attributeDescriptions()
    {
        return [];
    }

    public function getAttributeDescription($attribute)
    {
        $descriptions = $this->attributeDescriptions();

        return (isset($descriptions[$attribute])) ? $descriptions[$attribute] : '';
    }
}
