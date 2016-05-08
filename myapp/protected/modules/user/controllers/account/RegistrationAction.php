<?php
/**
 * Экшн, отвечающий за регистрацию нового пользователя
 *
 * @category CoreComponents
 * @package  core.modules.user.controllers.account
 * @author   CoreTeam <team@websum.uz>
 * @license  BSD http://ru.wikipedia.org/wiki/%D0%9B%D0%B8%D1%86%D0%B5%D0%BD%D0%B7%D0%B8%D1%8F_BSD
 * @version  0.7
 * @link     http://websum.uz
 *
 **/
use core\helpers\Url;

class RegistrationAction extends CAction
{
    
    public function run()
    {
        
        $module = Yii::app()->getModule('user');

        if ($module->registrationDisabled) {
            throw new CHttpException(404, Yii::t('UserModule.user', 'requested page was not found!'));
        }

        $form = new RegistrationForm;

        if (($data = Yii::app()->getRequest()->getPost('RegistrationForm')) !== null) {

            $form->setAttributes($data);

            if ($form->validate()) {

                if ($user = Yii::app()->userManager->createUser($form)) { //$user = Yii::app()->userManager->createUser($form)

                    Yii::app()->getUser()->setFlash(
                        core\widgets\YFlashMessages::SUCCESS_MESSAGE,
                        Yii::t('UserModule.user', 'Account was created! Check your email!')
                    );

                    
                    if(Yii::app()->request->isAjaxRequest){
                        Yii::app()->clientscript->scriptMap['jquery.min.js'] = false;
                        
                        Yii::app()->clientScript->registerScript('loading', ' 
                               $(function(){
                                    window.location.href = "/login"; 
                                    return false;
                               });  
                        ', CClientScript::POS_READY);
                        $this->getController()->renderPartial('registration', ['model' => $form, 'module' => $module],false, true);
                        Yii::app()->end();
                    } else {
                        $this->getController()->redirect(Url::redirectUrl($module->registrationSuccess));
                    }
                    
                }

                Yii::app()->getUser()->setFlash(
                    core\widgets\YFlashMessages::ERROR_MESSAGE,
                    Yii::t('UserModule.user', 'Error creating account!')
                );
            }
        }
        if(Yii::app()->request->isAjaxRequest){
            Yii::app()->clientscript->scriptMap['jquery.min.js'] = false; 
            $this->getController()->renderPartial('registration', ['model' => $form, 'module' => $module],false, true);
            Yii::app()->end();
        } else {
            $this->getController()->render('registration', ['model' => $form, 'module' => $module]);
        }
        
        }
    
}