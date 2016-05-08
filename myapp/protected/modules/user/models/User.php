<?php

/**
 * This is the model class for table "{{user_user}}".
 *
 * The followings are the available columns in table '{{user_user}}':
 * @property integer $id
 * @property string  $update_time
 * @property string  $first_name
 * @property string  $middle_name
 * @property string  $last_name
 * @property string  $sid
 * @property string  $email
 * @property integer $user_type
 * @property string  $avatar
 * @property string  $hash
 * @property integer $status
 * @property integer $access_level
 * @property string  $visit_time
 * @property boolean $email_confirm
 * @property string  $create_time
 *
 */
class User extends core\models\YModel
{
    /**
     *
     */
    const USER_TYPE_INDIVIDUAL = 1;
    /**
     *
     */
    const USER_TYPE_ENTITY = 2;
    /**
     *
     */
    const STATUS_BLOCK = 0;
    /**
     *
     */
    const STATUS_ACTIVE = 1;
    /**
     *
     */
    const STATUS_NOT_ACTIVE = 2;

    /**
     *
     */
    const EMAIL_CONFIRM_NO = 0;
    /**
     *
     */
    const EMAIL_CONFIRM_YES = 1;

    /**
     *
     */
    const ACCESS_LEVEL_USER = 0;
    /**
     *
     */
    const ACCESS_LEVEL_ADMIN = 1;

    /**
     * @var
     */
    private $_oldAccess_level;
    /**
     * @var
     */
    private $_oldStatus;
    /**
     * @var bool
     */
    public $use_gravatar = false;
    
    
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{user_user}}';
    }

    /**
     * Returns the static model of the specified AR class.
     *
     * @return User the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        $module = Yii::app()->getModule('user');

        return [
            [
                'birth_date, about, location, first_name, last_name, middle_name, email',
                'filter',
                'filter' => 'trim'
            ],
            [
                'birth_date, about, location, first_name, last_name, middle_name, email',
                'filter',
                'filter' => [$obj = new CHtmlPurifier(), 'purify']
            ],
            ['sid, email, hash, phone', 'required'],
            ['first_name, last_name, middle_name, email', 'length', 'max' => 50],
            ['hash', 'length', 'max' => 256],
            ['about', 'length', 'max' => 300],
            ['location', 'length', 'max' => 150],
            ['user_type, status, access_level', 'numerical', 'integerOnly' => true],
            ['user_type', 'default', 'value' => self::USER_TYPE_INDIVIDUAL, 'setOnEmpty' => true],
            ['email', 'email'],
            ['email', 'unique', 'message' => Yii::t('UserModule.user', 'This email already use by another user')],
            [
                'avatar',
                'file',
                'types' => $module->avatarExtensions,
                'maxSize' => $module->avatarMaxSize,
                'allowEmpty' => true,
                'safe' => false
            ],
            ['email_confirm', 'in', 'range' => array_keys($this->getEmailConfirmStatusList())],
            ['status', 'in', 'range' => array_keys($this->getStatusList())],
            ['create_time', 'length', 'max' => 50],
            ['active_date, session_user, update_time, create_time','safe'],
            [
                'id, sid, update_time, create_time, middle_name, first_name, last_name, email, user_type, avatar, status, access_level, visit_time, phone',
                'safe',
                'on' => 'search'
            ],
            ['birth_date', 'default', 'setOnEmpty' => true, 'value' => null],
        ];
    }

    public function behaviors()
    {
        
        return [
            'CTimestampBehavior' => [
                'class'             => 'zii.behaviors.CTimestampBehavior',
                'setUpdateOnCreate' => true,
            ],
        ];
    }

    /**
     * Массив связей:
     *
     * @return array
     */
    public function relations()
    {
        return [
            // Все токены пользователя:
            'tokens' => [
                self::HAS_MANY,
                'UserToken',
                'user_id'
            ]
        ];
    }
    
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('UserModule.user', 'Id'),
            'creation_date' => Yii::t('UserModule.user', 'Activated at'),
            'update_time' => Yii::t('UserModule.user', 'Updated at'),
            'first_name' => Yii::t('UserModule.user', 'Namefirst'),
            'last_name' => Yii::t('UserModule.user', 'Last name'),
            'middle_name' => Yii::t('UserModule.user', 'Family name'),
            'full_name' => Yii::t('UserModule.user', 'Full name'),
            'sid' => Yii::t('UserModule.user', 'Id'),
            'email' => Yii::t('UserModule.user', 'Email'),
            'user_type' => Yii::t('UserModule.user', 'User type'),
            'status' => Yii::t('UserModule.user', 'Status'),
            'access_level' => Yii::t('UserModule.user', 'Access'),
            'visit_time' => Yii::t('UserModule.user', 'Last visit'),
            'create_time' => Yii::t('UserModule.user', 'Register date'),
            'avatar' => Yii::t('UserModule.user', 'Avatar'),
            'use_gravatar' => Yii::t('UserModule.user', 'Gravatar'),
            'email_confirm' => Yii::t('UserModule.user', 'Email was confirmed'),
            'birth_date' => Yii::t('UserModule.user', 'Birthday'),
            'site' => Yii::t('UserModule.user', 'Site/blog'),
            'location' => Yii::t('UserModule.user', 'Location'),
            'about' => Yii::t('UserModule.user', 'About yourself'),
            'phone'=> Yii::t('UserModule.user', 'phone'),
            'active_date'=> Yii::t('UserModule.user', 'active_date'),   
        ];
    }

    /**
     * Проверка верификации почты:
     *
     * @return boolean
     */
    public function getIsVerifyEmail()
    {
        return $this->email_confirm;
    }

    /**
     * Строковое значение верификации почты пользователя:
     *
     * @return string
     */
    public function getIsVerifyEmailStatus()
    {
        return $this->getIsVerifyEmail()
            ? Yii::t('UserModule.user', 'Yes')
            : Yii::t('UserModule.user', 'No');
    }

    /**
     * Поиск пользователей по заданным параметрам:
     *
     * @return CActiveDataProvider
     */
    public function search($pageSize = 10)
    {
        $criteria = new CDbCriteria();

        $criteria->compare('t.id', $this->id);
        $criteria->compare('t.update_time', $this->update_time, true);
        if ($this->create_time) {
            $criteria->compare('t.create_time', date('Y-m-d', strtotime($this->create_time)), true);
        }
        $criteria->compare('t.first_name', $this->first_name, true);
        $criteria->compare('t.middle_name', $this->middle_name, true);
        $criteria->compare('t.last_name', $this->last_name, true);
        $criteria->compare('t.sid', $this->sid, true);
        $criteria->compare('t.email', $this->email, true);
        $criteria->compare('t.user_type', $this->user_type);
        $criteria->compare('t.status', $this->status);
        $criteria->compare('t.access_level', $this->access_level);
        if ($this->visit_time) {
            $criteria->compare('t.visit_time', date('Y-m-d', strtotime($this->visit_time)), true);
        }
        $criteria->compare('t.email_confirm', $this->email_confirm);

        return new CActiveDataProvider(get_class($this), [
            'criteria' => $criteria,
            'pagination' => [
                'pageSize' => $pageSize,
            ],
            'sort' => [
                'defaultOrder' => 'visit_time DESC',
            ]
        ]);
    }

    /**
     * Метод после поиска:
     *
     * @return void
     */
    public function afterFind()
    {
        
        $this->_oldAccess_level = $this->access_level;
        $this->_oldStatus = $this->status;
        // Если пустое поле аватар - автоматически
        // включаем граватар:
        $this->use_gravatar = empty($this->avatar);

        parent::afterFind();
    }


    /**
     * Метод выполняемый перед сохранением:
     *
     * @return bool
     */
    public function beforeSave()
    {

        if (!$this->getIsNewRecord() && $this->_oldAccess_level === self::ACCESS_LEVEL_ADMIN) {
            // Запрещаем действия, при которых администратор
            // может быть заблокирован или сайт останется без
            // администратора:
            if (
                $this->admin()->count() == 1
                && ((int)$this->access_level === self::ACCESS_LEVEL_USER || (int)$this->status !== self::STATUS_ACTIVE)
            ) {
                $this->addError(
                    'access_level',
                    Yii::t('UserModule.user', 'You can\'t make this changes!')
                );

                return false;
            }
        }
        

        return parent::beforeSave();
    }


    /**
     * Метод перед удалением:
     *
     * @return bool
     */
    public function beforeDelete()
    {
        if ($this->_oldAccess_level == self::ACCESS_LEVEL_ADMIN && $this->admin()->count() == 1) {
            $this->addError(
                'access_level',
                Yii::t('UserModule.user', 'You can\'t make this changes!')
            );

            return false;
        }

        return parent::beforeDelete();
    }

    /**
     * Именнованные условия:
     *
     * @return array
     */
    public function scopes()
    {
        return [
            'active' => [
                'condition' => 't.status = :user_status',
                'params' => [
                    ':user_status' => self::STATUS_ACTIVE
                ],
            ],
            'registered' => [
                'condition' => 't.status = :user_status',
                'params' => [
                    ':user_status' => self::STATUS_NOT_ACTIVE
                ],
            ],
            'blocked' => [
                'condition' => 'status = :blocked_status',
                'params' => [':blocked_status' => self::STATUS_BLOCK],
            ],
            'admin' => [
                'condition' => 'access_level = :access_level',
                'params' => [':access_level' => self::ACCESS_LEVEL_ADMIN],
            ],
            'user' => [
                'condition' => 'access_level = :access_level',
                'params' => [':access_level' => self::ACCESS_LEVEL_USER],
            ],
        ];
    }

    /**
     * Список текстовых значений ролей:
     *
     * @return array
     */
    public function getAccessLevelsList()
    {
        return [
            self::ACCESS_LEVEL_ADMIN => Yii::t('UserModule.user', 'Administrator'),
            self::ACCESS_LEVEL_USER => Yii::t('UserModule.user', 'User'),
        ];
    }

    /**
     * Получаем строковое значение роли
     * пользователя:
     *
     * @return string
     */
    public function getAccessLevel()
    {
        $data = $this->getAccessLevelsList();

        return isset($data[$this->access_level]) ? $data[$this->access_level] : Yii::t('UserModule.user', '*no*');
    }

    /**
     * Список возможных статусов пользователя:
     *
     * @return array
     */
    public function getStatusList()
    {
        return [
            self::STATUS_ACTIVE => Yii::t('UserModule.user', 'Active'),
            self::STATUS_BLOCK => Yii::t('UserModule.user', 'Blocked'),
            self::STATUS_NOT_ACTIVE => Yii::t('UserModule.user', 'Not activated'),
        ];
    }

    /**
     * Получение строкового значения
     * статуса пользователя:
     *
     * @return string
     */
    public function getStatus()
    {
        $data = $this->getStatusList();

        return isset($data[$this->status])
            ? $data[$this->status]
            : Yii::t('UserModule.user', 'status is not set');
    }

    /**
     * @return array
     */
    public function getEmailConfirmStatusList()
    {
        return [
            self::EMAIL_CONFIRM_YES => Yii::t('UserModule.user', 'Yes'),
            self::EMAIL_CONFIRM_NO => Yii::t('UserModule.user', 'No'),
        ];
    }

    /**
     * @return string
     */
    public function getEmailConfirmStatus()
    {
        $data = $this->getEmailConfirmStatusList();

        return isset($data[$this->email_confirm]) ? $data[$this->email_confirm] : Yii::t(
            'UserModule.user',
            '*unknown*'
        );
    }

    /**
     * Список статусов половой принадлежности:
     *
     * @return array
     */
    public function getUserTypeList()
    {
        return [
            self::USER_TYPE_ENTITY => Yii::t('UserModule.user', 'User type entity'),
            self::USER_TYPE_INDIVIDUAL => Yii::t('UserModule.user', 'User type individual'),
        ];
    }

    /**
     * Получаем строковое значение половой
     * принадлежности пользователя:
     *
     * @return string
     */
    public function getUserType()
    {
        $data = $this->getUserTypeList();

        return isset($data[$this->user_type])
            ? $data[$this->user_type]
            : $data[self::USER_TYPE_INDIVIDUAL];
    }

    /**
     * Получить url аватарки пользователя:
     * -----------------------------------
     * Возвращаем именно url, так как на
     * фронте может быть любая вариация
     * использования, незачем ограничивать
     * разработчиков.
     *
     * @param int $size - требуемый размер аватарки в пикселях
     *
     * @return string - url аватарки
     */
    public function getAvatar($size = 64)
    {
        $size = (int)$size;

        $userModule = Yii::app()->getModule('user');

        // если это граватар
        if ($this->use_gravatar && $this->email) {
            return '/images/avatar.png';
            
            /*

             return 'http://gravatar.com/avatar/' . md5(trim($this->email)) . "?s=" . $size . "&d=" . urlencode(
                Yii::app()->createAbsoluteUrl('/') . $userModule->getDefaultAvatar()
            );             
             */
        }

        $avatar = $this->avatar;
        $path = $userModule->getUploadPath();

        if (!file_exists($path)) {
            $avatar = $userModule->defaultAvatar;
        }

        return Yii::app()->thumbnailer->thumbnail(
            $path . $avatar,
            $userModule->avatarsDir,
            $size,
            $size
        );
    }

    /**
     * Получаем полное имя пользователя:
     *
     * @param string $separator - разделитель
     *
     * @return string
     */
    public function getFullName($separator = ' ')
    {
        return ($this->first_name || $this->last_name)
            ? $this->last_name . $separator . $this->first_name . ($this->middle_name ? ($separator . $this->middle_name) : "")
            : $this->sid;
    }

    /**
     * Удаление старого аватара:
     *
     * @return boolean
     */
    public function removeOldAvatar()
    {
        if (!$this->avatar) {
            return true;
        }

        $basePath = Yii::app()->getModule('user')->getUploadPath();

        if (file_exists($basePath . $this->avatar)) {
            @unlink($basePath . $this->avatar);
        }

        //remove old resized avatars
        foreach (glob($basePath . '/thumbs/' . '*' . $this->avatar) as $thumb) {
            @unlink($thumb);
        }

        $this->avatar = null;

        return true;
    }

    /**
     * Устанавливает новый аватар
     *
     * @param CUploadedFile $uploadedFile
     *
     * @throws CException
     *
     * @return boolean
     */
    public function changeAvatar(CUploadedFile $uploadedFile)
    {
        $basePath = Yii::app()->getModule('user')->getUploadPath();

        //создаем каталог для аватарок, если не существует
        if (!is_dir($basePath) && !@mkdir($basePath, 0755, true)) {
            throw new CException(Yii::t('UserModule.user', 'It is not possible to create directory for avatars!'));
        }

        $filename = $this->id . '_' . time() . '.' . $uploadedFile->extensionName;

        $this->removeOldAvatar();

        if (!$uploadedFile->saveAs($basePath . $filename)) {
            throw new CException(Yii::t('UserModule.user', 'It is not possible to save avatar!'));
        }

        $this->use_gravatar = false;

        $this->avatar = $filename;

        return true;
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return (int)$this->status === self::STATUS_ACTIVE;
    }

    public function activate()
    {
        $this->status = self::STATUS_ACTIVE;
        $this->email_confirm = self::EMAIL_CONFIRM_YES;
        return $this;
    }

}
