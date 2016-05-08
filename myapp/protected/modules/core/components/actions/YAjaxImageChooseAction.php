<?php
/**
 * YAjaxImageUploadAction.php file.
 *
 * @category CoreComponents
 * @package  core.modules.core.components.actions
 * @author   Anton Kucherov <idexter.ru@gmail.com>
 * @license  BSD https://raw.github.com/core/core/master/LICENSE
 * @version  0.1
 * @link     http://websum.uz
 */

namespace core\components\actions;

use Yii;
use CAction;
use Image;

class YAjaxImageChooseAction extends CAction
{
    public function run()
    {
        if (Yii::app()->hasModule("image")) {
            $upPath = Yii::app()->getBaseUrl() . DIRECTORY_SEPARATOR . Yii::app()->getModule('core')->uploadPath .
                DIRECTORY_SEPARATOR . Yii::app()->getModule('image')->uploadPath .
                DIRECTORY_SEPARATOR;

            $images = Image::model()->findAllByAttributes(
                ['category_id' => null, 'parent_id' => null]
            );

            $forJson = [];

            if (!empty($images)) {
                foreach ($images as $img) {
                    $forJson[] = [
                        'thumb' => $upPath . $img->file,
                        'image' => $upPath . $img->file,
                        'title' => $upPath . $img->name
                    ];
                }
            }

            Yii::app()->ajax->raw($forJson);
        }
    }
}
