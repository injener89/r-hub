<?php
/**
 * YAjaxFileUploadAction.php file.
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
use core\helpers\YText;
use core\models\UploadForm;
use CUploadedFile;

/**
 * Class YAjaxFileUploadAction
 * @package core\components\actions
 */
class YAjaxFileUploadAction extends CAction
{
    /**
     * @var string
     */
    protected $fileLink = null;
    /**
     * @var string
     */
    protected $fileName = null;
    /**
     * @var CUploadedFile
     */
    protected $uploadedFile = null;

    /**
     * @var
     */
    public $uploadPath;
    /**
     * @var
     */
    public $rename = false;
    /**
     * @var
     */
    protected $webPath;

    /**
     * @var
     */
    public $maxSize;
    /**
     * @var
     */
    public $mimeTypes;
    /**
     * @var
     */
    public $types;

    /**
     * Метод для загрузки файлов из редактора при создании контента
     *
     * @since 0.4
     *
     * Подробнее http://imperavi.com/redactor/docs/images/
     *
     * @throw \CHttpException
     * @return void
     */
    public function run()
    {
        if (!Yii::app()->getRequest()->getIsPostRequest()) {
            throw new \CHttpException(404);
        }

        if (empty($_FILES['file']['name'])) {
            Yii::app()->ajax->raw(
                ['error' => Yii::t('CoreModule.core', 'There is an error when downloading!')]
            );
        }

        $this->webPath = '/' . $this->getController()->core->uploadPath . '/files/' . date('Y/m/d') . '/';
        $this->uploadPath = Yii::getPathOfAlias('webroot') . $this->webPath;

        if (!is_dir($this->uploadPath)) {
            if (!@mkdir($this->uploadPath, 0755, true)) {
                Yii::app()->ajax->raw(
                    [
                        'error' => Yii::t(
                                'CoreModule.core',
                                'Can\'t create catalog "{dir}" for files!',
                                ['{dir}' => $this->uploadPath]
                            )
                    ]
                );
            }
        }

        $this->getController()->disableProfilers();

        $this->uploadedFile = CUploadedFile::getInstanceByName('file');

        $form = new UploadForm();
        $form->maxSize = $this->maxSize ? : null;
        $form->mimeTypes = $this->mimeTypes ? : null;
        $form->types = $this->types ? : null;
        $form->file = $this->uploadedFile;

        if ($form->validate() && $this->uploadFile() && ($this->fileLink !== null && $this->fileName !== null)) {
            Yii::app()->ajax->raw(
                ['filelink' => $this->fileLink, 'filename' => $this->fileName]
            );
        } else {
            Yii::app()->ajax->raw(['error' => join("\n", $form->getErrors("file"))]);
        }
    }

    /**
     * @return bool
     */
    protected function uploadFile()
    {
        if (!$this->uploadedFile) {
            return false;
        }

        $name = $this->uploadedFile->name;
        $extension = $this->uploadedFile->extensionName;
        // сгенерировать имя файла и сохранить его,
        // если не включено переименование, то все равно имя переводится в транслит, чтобы не было проблем
        $fileName = $this->rename ?
            md5(time() . uniqid() . $name) . '.' . $extension :
            YText::translit(
                basename($name, $extension)
            ) . '_' . time() . '.' . $extension;

        if (!$this->uploadedFile->saveAs($this->uploadPath . $fileName)) {
            Yii::app()->ajax->raw(
                ['error' => Yii::t('CoreModule.core', 'There is an error when downloading!')]
            );
        }

        $this->fileLink = Yii::app()->getBaseUrl() . $this->webPath . $fileName;
        $this->fileName = $name;

        return true;
    }
}
