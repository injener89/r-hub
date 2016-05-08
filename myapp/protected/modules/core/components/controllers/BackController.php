<?php
/**
 * Базовый класс для всех контроллеров панели управления
 *
 * @category CoreComponents
 * @package  core.modules.core.components.controllers
 * @author   CoreTeam <team@websum.uz>
 * @license  BSD https://raw.github.com/core/core/master/LICENSE
 * @version  0.6
 * @link     http://websum.uz
 *
 */

namespace core\components\controllers;

use Yii;
use core\components\WebModule;
use core\events\CoreBackendControllerInitEvent;
use core\events\CoreControllerInitEvent;
use core\events\CoreEvents;
use core\widgets\YFlashMessages;
use application\components\Controller;
use CHttpException;
use CActiveRecord;
use Exception;
use CLogger;

/**
 * Class BackController
 * @package core\components\controllers
 */
abstract class BackController extends Controller
{
    /**
     *
     */
    const BULK_DELETE = 'delete';

    // Прятать sidebar или нет:
    /**
     * @var bool
     */
    public $hideSidebar = false;

    /**
     * @return array
     */
    public function filters()
    {
        return Yii::app()->getModule('core')->getBackendFilters();
    }

    /**
     * По умолчанию для роли admin разрешены все действия.
     * @return array
     */
    public function accessRules()
    {
        return [
            ['allow', 'roles' => ['admin']],
            ['deny']
        ];
    }

    /**
     *
     */
    public function init()
    {
        parent::init();

        $this->core->getComponent('bootstrap');
        $this->layout = $this->core->getBackendLayoutAlias();
        $backendTheme = $this->core->backendTheme;
        $this->pageTitle = Yii::t('CoreModule.core', 'Core control panel!');

        if ($this->core->hidePanelUrls == WebModule::CHOICE_NO) {
            Yii::app()->getErrorHandler()->errorAction = '/core/backend/error';
        }

        Yii::app()->eventManager->fire(
            CoreEvents::BACKEND_CONTROLLER_INIT,
            new CoreControllerInitEvent($this, Yii::app()->getUser())
        );

        if ($backendTheme) {
            Yii::app()->theme = "backend_" . $backendTheme;
        } else {
            Yii::app()->theme = $this->core->theme;
        }
    }

    /**
     * @param  \CAction $action
     * @return bool
     */
    protected function beforeAction($action)
    {
        /**
         * $this->module->getId() !== 'install' избавляет от ошибок на этапе установки
         * $this->id !== 'backend' || ($this->id == 'backend' && $action->id != 'modupdate') устраняем проблемы с зацикливанием
         */
        if (($this->id !== 'backend' || ($this->id == 'backend' && $action->id != 'modupdate'))
            && ($updates = Yii::app()->migrator->checkForUpdates(
                [$this->module->getId() => $this->module]
            )) !== null
            && count($updates) > 0
        ) {
            Yii::app()->getUser()->setFlash(
                YFlashMessages::WARNING_MESSAGE,
                Yii::t('CoreModule.core', 'You must install all migration before start working with module.')
            );

            $this->redirect(['/core/backend/modupdate', 'name' => $this->module->getId()]);
        }

        return parent::beforeAction($action);
    }

    /**
     * @throws \CHttpException
     */
    public function actionMultiaction()
    {
        if (!Yii::app()->getRequest()->getIsAjaxRequest() || !Yii::app()->getRequest()->getIsPostRequest()) {
            throw new CHttpException(404);
        }

        $modelClass = Yii::app()->getRequest()->getPost('model');
        $action = Yii::app()->getRequest()->getPost('do');

        if (!isset($modelClass, $action)) {
            throw new CHttpException(404);
        }

        $items = Yii::app()->getRequest()->getPost('items');

        if (!is_array($items) || empty($items)) {
            Yii::app()->ajax->success();
        }

        $transaction = Yii::app()->getDb()->beginTransaction();

        try {
            switch ($action) {
                case self::BULK_DELETE:

                    $models = CActiveRecord::model($modelClass)->findAllByPk($items);

                    $count = 0;

                    foreach ($models as $model) {
                        $count += (int)$model->delete();
                    }

                    $transaction->commit();

                    Yii::app()->ajax->success(
                        Yii::t(
                            'CoreModule.core',
                            'Removed {count} records!',
                            [
                                '{count}' => $count
                            ]
                        )
                    );
                    break;

                default:
                    throw new CHttpException(404);
                    break;
            }
        } catch (Exception $e) {
            $transaction->rollback();
            Yii::log($e->__toString(), CLogger::LEVEL_ERROR);
            Yii::app()->ajax->failure($e->getMessage());
        }
    }

    /**
     * @throws \CHttpException
     */
    public function actionSort()
    {
        $id = (int)Yii::app()->getRequest()->getQuery('id');
        $direction = Yii::app()->getRequest()->getQuery('direction');
        $modelClass = Yii::app()->getRequest()->getQuery('model');
        $sortField = Yii::app()->getRequest()->getQuery('sortField');

        if (!isset($direction, $id, $modelClass, $sortField)) {
            throw new CHttpException(404, Yii::t('CoreModule.core', 'Page was not found!'));
        }

        $model = new $modelClass();
        $model_depends = new $modelClass();
        $model = $model->resetScope()->findByPk($id);
        if (!$model) {
            throw new CHttpException(404, Yii::t('CoreModule.core', 'Page was not found!'));
        }

        if ($direction === 'up') {
            $model_depends = $model_depends->findByAttributes([$sortField => ($model->$sortField - 1)]);
            $model_depends->$sortField++;
            $model->$sortField--; // example menu_order column in sql
        } else {
            $model_depends = $model_depends->findByAttributes([$sortField => ($model->$sortField + 1)]);
            $model_depends->$sortField--;
            $model->$sortField++;
        }

        $model->update([$sortField]);
        $model_depends->update([$sortField]);

        if (!Yii::app()->getRequest()->getIsAjaxRequest()) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : ['index']);
        }
    }
}
