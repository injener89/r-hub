<?php

/**
 * Контроллер, отвечающий за отображение списка пользователей и профиля пользователя в публичной части сайта
 *
 * @category CoreComponents
 * @package  core.modules.user.controllers
 * @author   CoreTeam <team@websum.uz>
 * @license  BSD http://ru.wikipedia.org/wiki/%D0%9B%D0%B8%D1%86%D0%B5%D0%BD%D0%B7%D0%B8%D1%8F_BSD
 * @version  0.5.3
 * @link     http://websum.uz
 *
 **/
class PeopleController extends \core\components\controllers\FrontController
{
    // Вывод публичной страницы всех пользователей
    public function actionIndex()
    {
        throw new CHttpException(404, Yii::t('UserModule.user', 'User was not found'));
        
        
        $users = new User('search');
        $users->unsetAttributes();
        $users->status = User::STATUS_ACTIVE;

        if (isset($_GET['User']['sid'])) {
            $users->sid = CHtml::encode($_GET['User']['sid']);
        }

        //$this->render('index', ['users' => $users, 'provider' => $users->search((int)$this->module->usersPerPage)]);
    }

    // Вывод публичной страницы пользователя
    public function actionUserInfo($username)
    {
        throw new CHttpException(404, Yii::t('UserModule.user', 'User was not found'));
        
        $user = User::model()->active()->findByAttributes(["sid" => $username]);

        if (null === $user) {
            throw new CHttpException(404, Yii::t('UserModule.user', 'User was not found'));
        }

        //$this->render('userInfo', ['user' => $user]);
    }
}
