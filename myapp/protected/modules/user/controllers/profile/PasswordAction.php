<?php

/**
 * Экшн, отвечающий за смену пароля пользователя
 *
 * @category CoreComponents
 * @package  core.modules.user.controllers.account
 * @author   CoreTeam <team@websum.uz>
 * @license  BSD http://ru.wikipedia.org/wiki/%D0%9B%D0%B8%D1%86%D0%B5%D0%BD%D0%B7%D0%B8%D1%8F_BSD
 * @version  0.8
 * @link     http://websum.uz
 *
 **/
class PasswordAction extends CAction
{
    public function run()
    {
        $user = $this->controller->user;
        $form = new ProfilePasswordForm();

        if (($data = Yii::app()->getRequest()->getPost('ProfilePasswordForm')) !== null) {
            $form->setAttributes($data);
            if ($form->validate()) {
                $user->hash = Yii::app()->userManager->hasher->hashPassword($form->password);
                if ($user->save()) {
                    Yii::app()->getUser()->setFlash(
                        core\widgets\YFlashMessages::SUCCESS_MESSAGE,
                        Yii::t('UserModule.user', 'Your password was changed successfully.')
                    );
                    $this->getController()->redirect(['/user/profile/profile']);
                }
            }
        }
        $this->getController()->render('password', ['model' => $form]);
    }
}
