<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use core\helpers\Url;

class LoginWidget extends core\widgets\YWidget
{
    public $view = 'login-widget';
    
    public function run()
    {
        
        $badLoginCount = Yii::app()->authenticationManager->getBadLoginCount(Yii::app()->getUser());

        $module = Yii::app()->getModule('user');

        $scenario = $badLoginCount > (int)$module->badLoginCount ? LoginForm::LOGIN_LIMIT_SCENARIO : '';
        
        $RCount = $badLoginCount >= (int)$module->badLoginCount ? 1 : 0;

        $form = new LoginForm($scenario);
        
   if (Yii::app()->getRequest()->getIsPostRequest() && !empty($_POST['LoginForm'])) {

            $form->setAttributes(Yii::app()->getRequest()->getPost('LoginForm'));
            
            
            if ($form->validate() && Yii::app()->authenticationManager->login(
                    $form,
                    Yii::app()->getUser(),
                    Yii::app()->getRequest()
                )
            ) {
               
                // если запрос асинхронный, то нам нужно отдать только данные
                if(Yii::app()->request->isAjaxRequest){
                    
                    if (Yii::app()->getUser()->isSuperUser() && $module->loginAdminSuccess) {
                         $redirect = [$module->loginAdminSuccess];
                     } else {
                         $redirect = empty($module->loginSuccess) ? Yii::app()->getBaseUrl() : [$module->loginSuccess];
                     }
                     $output['redirect'] = Yii::app()->getUser()->getReturnUrl($redirect);
                     $output['massage'] = Yii::t('UserModule.user', 'You authorized successfully!');
                     $output['status'] = 1;
                     $output['RCount'] = $RCount;
                     $output['class'] = 'alert-success';
                     Yii::app()->authenticationManager->setBadLoginCount(Yii::app()->getUser(), 0);
                    
                     echo CJSON::encode($output);
                     Yii::app()->end();
                } else {
                        Yii::app()->getUser()->setFlash(
                         core\widgets\YFlashMessages::SUCCESS_MESSAGE,
                         Yii::t('UserModule.user', 'You authorized successfully!')
                     );

                     if (Yii::app()->getUser()->isSuperUser() && $module->loginAdminSuccess) {
                         $redirect = [$module->loginAdminSuccess];
                     } else {
                         $redirect = empty($module->loginSuccess) ? Yii::app()->getBaseUrl() : [$module->loginSuccess];
                     }

                     $redirect = Yii::app()->getUser()->getReturnUrl($redirect);

                     Yii::app()->authenticationManager->setBadLoginCount(Yii::app()->getUser(), 0);

                     $this->getController()->redirect($redirect); 
                }
            } else {
                
                // если запрос асинхронный, то нам нужно отдать только данные
                if(Yii::app()->request->isAjaxRequest){
                     
                   
                    
                     $form->addError('email', Yii::t('UserModule.user', 'Email or password was typed wrong!'));
                     $error = '<p>Необходимо исправить следующие ошибки:</p><ul>';
                     foreach ($form->getErrors() as $key => $errors)
                     {
                         foreach ($errors as $errorMas)
                            {
                                $error .= '<li>'.$errorMas.'</li>';
                            }
                         
                     }
                     $error .= '</ul>';
                     
                    
                     $output['redirect'] = 0;
                     $output['massage'] = $error;
                     $output['status'] = 0;
                     $output['RCount'] = $RCount;
                     $output['class'] = 'alert-danger';
                     Yii::app()->authenticationManager->setBadLoginCount(Yii::app()->getUser(), $badLoginCount + 1);
                    
                     echo CJSON::encode($output);
                     Yii::app()->end();
                     
                } else {
                    
                    $form->addError('email', Yii::t('UserModule.user', 'Email or password was typed wrong!'));
                    Yii::app()->authenticationManager->setBadLoginCount(Yii::app()->getUser(), $badLoginCount + 1);
                }
                
                
            }
        }
        //$this->renderPartial($this->view,array('model' => $form),false,true);
        $this->render($this->view, ['model' => $form]);
    }
}

