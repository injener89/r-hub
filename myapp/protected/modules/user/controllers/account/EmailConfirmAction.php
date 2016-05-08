<?php

/**
 * Экшн, отвечающий за подтверждение email пользователя
 *
 * @category CoreComponents
 * @package  core.modules.user.controllers.account
 * @author   CoreTeam <team@websum.uz>
 * @license  BSD http://ru.wikipedia.org/wiki/%D0%9B%D0%B8%D1%86%D0%B5%D0%BD%D0%B7%D0%B8%D1%8F_BSD
 * @version  0.7
 * @link     http://websum.uz
 *
 **/
class EmailConfirmAction extends CAction
{
    public function run($token)
    {
        // пытаемся подтвердить почту
        if (Yii::app()->userManager->verifyEmail($token)) {

            Yii::app()->getUser()->setFlash(
                core\widgets\YFlashMessages::SUCCESS_MESSAGE,
                Yii::t(
                    'UserModule.user',
                    'You confirmed new e-mail successfully!'
                )
            );

        } else {

            Yii::app()->getUser()->setFlash(
                core\widgets\YFlashMessages::ERROR_MESSAGE,
                Yii::t(
                    'UserModule.user',
                    'Activation error! Maybe e-mail already confirmed or incorrect activation code was used. Try to use another e-mail'
                )
            );
        }

        $this->getController()->redirect(
            Yii::app()->getUser()->isAuthenticated()
                ? ['/user/profile/profile']
                : ['/user/account/login']
        );
    }
}
