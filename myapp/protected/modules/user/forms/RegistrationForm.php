<?php

/**
 * Форма регистрации
 *
 * @category CoreComponents
 * @package  core.modules.user.forms
 * @author   CoreTeam <team@websum.uz>
 * @license  BSD http://ru.wikipedia.org/wiki/%D0%9B%D0%B8%D1%86%D0%B5%D0%BD%D0%B7%D0%B8%D1%8F_BSD
 * @version  0.5.3
 * @link     http://websum.uz
 *
 **/
class RegistrationForm extends CFormModel
{

    public $email;
    public $password;
    public $cPassword;
    public $verifyCode;
    
    public $user_type;
    public $first_name;
    public $last_name;
    public $phone;
    public $agree;

    public $disableCaptcha = false;

    public function isCaptchaEnabled()
    {
        $module = Yii::app()->getModule('user');

        if (!$module->showCaptcha || !CCaptcha::checkRequirements() || $this->disableCaptcha) {
            return false;
        }

        return true;
    }

    public function rules()
    {
        $module = Yii::app()->getModule('user');

        return [
            ['first_name, last_name, email', 'filter', 'filter' => 'trim'],
            ['first_name, last_name, email', 'filter', 'filter' => [new CHtmlPurifier(), 'purify']],
            ['user_type, agree, first_name, last_name, email, password, cPassword, phone', 'required'],
            ['email', 'length', 'max' => 50],
            ['password, cPassword', 'length', 'min' => $module->minPasswordLength],
            [
                'agree',
                'match',
                'pattern' => '/^[1]{1,1}$/',
                'message' => Yii::t(
                        'UserModule.user',
                        'Agree non'
                    )
            ],
            [
                'user_type',
                'match',
                'pattern' => '/^[1-2]{1,1}$/',
                'message' => Yii::t(
                        'UserModule.user',
                        'Select the type of user'
                    )
            ],
            ['user_type', 'numerical', 'integerOnly' => true],
            ['phone', 'checkPhone'],
            [
                'cPassword',
                'compare',
                'compareAttribute' => 'password',
                'message'          => Yii::t('UserModule.user', 'Password is not coincide')
            ],
            ['email', 'email'],
            ['email', 'checkEmail'],
            [
                'verifyCode',
                'core\components\validators\YRequiredValidator',
                'allowEmpty' => !$this->isCaptchaEnabled(),
                'message'    => Yii::t('UserModule.user', 'Check code incorrect')
            ],
            ['verifyCode', 'captcha', 'allowEmpty' => !$this->isCaptchaEnabled()],
            ['verifyCode', 'emptyOnInvalid']
        ];
    }

    public function attributeLabels()
    {
        return [
            'email'      => Yii::t('UserModule.user', 'Email'),
            'password'   => Yii::t('UserModule.user', 'Password'),
            'cPassword'  => Yii::t('UserModule.user', 'Password confirmation'),
            'verifyCode' => Yii::t('UserModule.user', 'Check code'),
            'first_name' => Yii::t('UserModule.user', 'Namefirst'),
            'last_name' => Yii::t('UserModule.user', 'Last name'),
            'phone'=> Yii::t('UserModule.user', 'phone'),
            'agree'=> Yii::t('UserModule.user', 'Agree'),
            'user_type'=> Yii::t('UserModule.user', 'I registered as a'),
            
        ];
    }

    public function checkPhone($attribute, $params)
    {
        $model = User::model()->find('phone = :phone', [':phone' => $this->$attribute]);

        if ($model) {
            $this->addError('phone', Yii::t('UserModule.user', 'User name already exists'));
        }
    }

    public function checkEmail($attribute, $params)
    {
        $model = User::model()->find('email = :email', [':email' => $this->$attribute]);

        if ($model) {
            $this->addError('email', Yii::t('UserModule.user', 'Email already busy'));
        }
    }

    public function emptyOnInvalid($attribute, $params)
    {
        if ($this->hasErrors()) {
            $this->verifyCode = null;
        }
    }
}
