<?php

/**
 * Форма профиля
 *
 * @category CoreComponents
 * @package  core.modules.user.forms
 * @author   CoreTeam <team@websum.uz>
 * @license  BSD http://ru.wikipedia.org/wiki/%D0%9B%D0%B8%D1%86%D0%B5%D0%BD%D0%B7%D0%B8%D1%8F_BSD
 * @version  0.5.3
 * @link     http://websum.uz
 *
 **/
class ProfileForm extends CFormModel
{
    public $sid;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $verifyCode;
    public $use_gravatar;
    public $avatar;
    
    public $phone;

    public function rules()
    {
        $module = Yii::app()->getModule('user');

        return [
            ['sid, first_name, last_name, middle_name', 'filter', 'filter' => 'trim'],
            [
                'sid, first_name, last_name, middle_name',
                'filter',
                'filter' => [$obj = new CHtmlPurifier(), 'purify']
            ],
            ['sid, phone', 'required'],
            ['sid, first_name, last_name, middle_name', 'length', 'max' => 50],
            [
                'sid',
                'match',
                'pattern' => '/^[0-9]{4,8}$/',
                'message' => Yii::t(
                        'UserModule.user',
                        'Select the type of user'
                    )
            ],
            ['sid', 'checkNickName'],
            ['use_gravatar', 'in', 'range' => [0, 1]],
            [
                'avatar',
                'file',
                'types'      => $module->avatarExtensions,
                'maxSize'    => $module->avatarMaxSize,
                'allowEmpty' => true
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'first_name'   => Yii::t('UserModule.user', 'Name'),
            'last_name'    => Yii::t('UserModule.user', 'Last name'),
            'middle_name'  => Yii::t('UserModule.user', 'Family name'),
            'sid'    => Yii::t('UserModule.user', 'User name'),
            'phone' => Yii::t('UserModule.user', 'phone'),
            'avatar'       => Yii::t('UserModule.user', 'Avatar'),
            'use_gravatar' => Yii::t('UserModule.user', 'Gravatar'),
        ];
    }

    public function checkNickName($attribute, $params)
    {
        // Если ник поменяли
        if (Yii::app()->user->profile->sid != $this->$attribute) {
            $model = User::model()->find('sid = :sid', [':sid' => $this->$attribute]);
            if ($model) {
                $this->addError('sid', Yii::t('UserModule.user', 'Nick in use'));
            }
        }
    }
}
