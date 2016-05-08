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
use Image;

class YAjaxImageUploadAction extends YAjaxFileUploadAction
{
    public function init()
    {
        parent::init();
    }

    protected function uploadFile()
    {
        if (!$this->uploadedFile || !Yii::app()->hasModule('image')) {
            return false;
        }

        if (false === getimagesize($this->uploadedFile->getTempName())) {
            return false;
        }

        $image = new Image();
        $image->setScenario('insert');
        $image->addFileInstanceName('file');
        $image->setAttribute('name', $this->uploadedFile->getName());
        $image->setAttribute('alt', $this->uploadedFile->getName());
        $image->setAttribute('type', Image::TYPE_SIMPLE);

        if ($image->save()) {

            $this->fileLink = $image->getImageUrl();
            $this->fileName = $image->getName();

            return true;
        }

        return false;
    }
}
