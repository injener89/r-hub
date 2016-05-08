<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class RegWidget extends core\widgets\YWidget
{
    public $view = 'reg';
    public $form;
    public $model;
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

                    // если запрос асинхронный, то нам нужно отдать только данные
                    if(Yii::app()->request->isAjaxRequest){
                         $output['redirect'] = Url::redirectUrl($module->registrationSuccess);
                         $output['massage'] = Yii::t('UserModule.user', 'Account was created! Check your email!');
                         $output['status'] = 1;
                         $output['RCount'] = 1;
                         $output['class'] = 'alert-success';
                         echo CJSON::encode($output);
                         Yii::app()->end();
                    } else {

                         Yii::app()->getUser()->setFlash(
                            core\widgets\YFlashMessages::SUCCESS_MESSAGE,
                            Yii::t('UserModule.user', 'Account was created! Check your email!')
                        );

                        $this->getController()->redirect(Url::redirectUrl($module->registrationSuccess));
                    }
                    
                }   
                if(Yii::app()->request->isAjaxRequest){ // если запрос асинхронный, то нам нужно отдать только данные
                     $output['redirect'] = 0;
                     $output['massage'] = Yii::t('UserModule.user', 'Error creating account!');
                     $output['status'] = 0;
                     $output['RCount'] = 0;
                     $output['class'] = 'alert-danger';    
                     echo CJSON::encode($output);
                     Yii::app()->end();
                } else {
                    Yii::app()->getUser()->setFlash(
                        core\widgets\YFlashMessages::ERROR_MESSAGE,
                        Yii::t('UserModule.user', 'Error creating account!')
                    );
                }
                
            } else {
                if(Yii::app()->request->isAjaxRequest){ // если запрос асинхронный, то нам нужно отдать только данные
 
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
                     $output['RCount'] = 0;
                     $output['class'] = 'alert-danger';    
                     echo CJSON::encode($output);
                     Yii::app()->end();
                     
                } 
            }
        }
        $this->render($this->view, ['model' => $form, 'module' => $module]);
    }
}

