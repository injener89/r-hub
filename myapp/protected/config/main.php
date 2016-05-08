<?php

/**
 * Файл основных настроек приложения
 *
 * ВНИМАНИЕ! ДАННЫЙ ФАЙЛ ИСПОЛЬЗУЕТСЯ ЯДРОМ YUPE!
 * ИЗМЕНЕНИЯ В ДАННОМ ФАЙЛЕ МОГУТ ПРИВЕСТИ К ПОТЕРЕ РАБОТОСПОСОБНОСТИ
 * Для собственных настроек создайте и используйте "/protected/config/userspace.php"
 * Подробную информацию по использованию "userspace" можно узнать из официальной
 * документаци - http://websum.uz/docs/core/userspace.config.html
 *
 * @category CoreConfig
 * @package  Core
 * @author   CoreTeam <team@websum.uz>
 * @license  BSD http://ru.wikipedia.org/wiki/%D0%9B%D0%B8%D1%86%D0%B5%D0%BD%D0%B7%D0%B8%D1%8F_BSD
 * @version  0.6
 * @link     http://websum.uz
 *
 **/

// Определяем алиасы:
Yii::setPathOfAlias('application', __DIR__ . '/../');
Yii::setPathOfAlias('public', dirname($_SERVER['SCRIPT_FILENAME']));
Yii::setPathOfAlias('core', __DIR__ . '/../modules/core/');
Yii::setPathOfAlias('vendor', __DIR__ . '/../../vendor/');
Yii::setPathOfAlias('themes', __DIR__ . '/../../themes/');

return [
    'basePath' => __DIR__ . '/..',
    // контроллер по умолчанию
    'defaultController' => 'site',
    // название приложения
    'name' => 'Websum',
    // язык по умолчанию
    'language' => 'ru',
    'sourceLanguage' => 'en',
    // тема оформления по умолчанию
    'theme' => 'default',
    'charset' => 'UTF-8',
    'controllerNamespace' => 'application\controllers',
    'preload' => defined('YII_DEBUG')
        && YII_DEBUG
            ? ['debug'] : [],
    'aliases' => [
        'bootstrap' => realpath(Yii::getPathOfAlias('vendor') . '/clevertech/yii-booster/src')
    ],
    'import' => [
        'application.modules.core.extensions.tagcache.*',
        'vendor.yiiext.migrate-command.EDbMigration'
    ],
    // подключение и конфигурирование модулей,
    // подробнее: http://www.yiiframework.ru/doc/guide/ru/basics.module
    'modules' => [
        'core' => [
            'class' => 'application.modules.core.CoreModule',
            'cache' => false
        ],
        // на продакшне gii рекомендуется отключить, подробнее: http://www.yiiframework.com/doc/guide/1.1/en/quickstart.first-app
       /* 'gii'   => array(
            'class'          => 'system.gii.GiiModule',
            'password'       => 'giiCore',
            'generatorPaths' => array(
                'application.modules.core.extensions.core.gii',
            ),
            'ipFilters'=>array(),
        ),*/
        
        /*'gii' => array(
        'class' => 'application.modules.gii.GiiModule',
        'password' => 'giiCore',
        'generatorPaths' => array(
        'application.modules.core.extensions.core.gii',
        ),
        'ipFilters'=>array(),
        ),*/
    ],
    'behaviors' => [
        'onBeginRequest' => [
            'class' => 'core\components\urlManager\LanguageBehavior'
        ]
    ],
    'params' => require __DIR__. '/params.php',
    // конфигурирование основных компонентов (подробнее http://www.yiiframework.ru/doc/guide/ru/basics.component)
    'components' => [
        'viewRenderer' => [
            'class' => 'vendor.yiiext.twig-renderer.ETwigViewRenderer',
            'twigPathAlias' => 'vendor.twig.twig.lib.Twig',
            // All parameters below are optional, change them to your needs
            'fileExtension' => '.twig',
            'options' => ['autoescape' => true],
            'globals' => ['html' => 'CHtml'],
            'filters' => ['jencode' => 'CJSON::encode']
        ],
        'debug' => ['class' => 'vendor.zhuravljov.yii2-debug.Yii2Debug', 'internalUrls' => false],
        // параметры подключения к базе данных, подробнее http://www.yiiframework.ru/doc/guide/ru/database.overview
        // используется лишь после установки Юпи:
        'db' => file_exists(__DIR__ . '/db.php') ? require_once __DIR__ . '/db.php' : [],
        'moduleManager' => ['class' => 'core\components\ModuleManager'],
        'eventManager' => ['class' => 'core\components\EventManager'],
        'configManager' => ['class' => 'core\components\ConfigManager'],
        // Работа с миграциями, обновление БД модулей
        'migrator' => ['class' => 'core\components\Migrator'],
        'uploadManager' => ['class' => 'core\components\UploadManager'],
        'bootstrap' => [
            'class' => 'bootstrap.components.Booster',
            'responsiveCss' => true,
            'fontAwesomeCss' => true
        ],
        "CoreAjaxWidget" =>[
            "class"=>"application.modules.core.extensions.websumAjax.CoreAjaxWidgetComponent"
        ],
        'themeManager' => [
            'class' => 'CThemeManager',
            'basePath' => dirname(__DIR__) . '/../themes',
            'themeClass' => 'core\components\Theme'
        ],
        'cache' => [
            'class' => 'CFileCache',
            'behaviors' => ['clear' => ['class' => 'application.modules.core.extensions.tagcache.TaggingCacheBehavior']]
        ],
        // конфигурирование urlManager, подробнее: http://www.yiiframework.ru/doc/guide/ru/topics.url
        'urlManager' => [
            'class' => 'core\components\urlManager\LangUrlManager',
            'languageInPath' => true,
            'langParam' => 'language',
            'urlFormat' => 'path',
            'urlSuffix' => '',
            'showScriptName' => false,
            // чтобы убрать index.php из url, читаем: http://yiiframework.ru/doc/guide/ru/quickstart.apache-nginx-config
            'cacheID' => 'cache',
            'useStrictParsing' => true,
            'rules' => [ // общие правила
                '/' => '/site/index',
                // для корректной работы устновщика
                '/install/default/<action:\w+>' => '/install/default/<action>',
                '/backend' => '/core/backend/index',
                '/backend/login' => '/user/account/backendlogin',
                '/backend/<action:\w+>' => '/core/backend/<action>',
                '/backend/<module:\w+>/<controller:\w+>' => '/<module>/<controller>Backend/index',
                '/backend/<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>' => '/<module>/<controller>Backend/<action>',
                '/backend/<module:\w+>/<controller:\w+>/<action:\w+>' => '/<module>/<controller>Backend/<action>',
                '/gii/<controller:\w+>/<action:\w+>' => 'gii/<controller>/<action>',
                '/site/<action:\w+>' => 'site/<action>',
                '/debug/<controller:\w+>/<action:\w+>' => 'debug/<controller>/<action>'
            ]
        ],
        // конфигурируем компонент CHttpRequest для защиты от CSRF атак, подробнее: http://www.yiiframework.ru/doc/guide/ru/topics.security
        // РЕКОМЕНДУЕМ УКАЗАТЬ СВОЕ ЗНАЧЕНИЕ ДЛЯ ПАРАМЕТРА "csrfTokenName"
        // базовый класс CHttpRequest переопределен для загрузки файлов через ajax, подробнее: http://www.yiiframework.com/forum/index.php/topic/8689-disable-csrf-verification-per-controller-action/
        'request' => [
            'class' => 'core\components\HttpRequest',
            'enableCsrfValidation' => true,
            'csrfCookie' => ['httpOnly' => true],
            'csrfTokenName' => 'CORE_TOKEN',
            'enableCookieValidation' => true,
            // подробнее: http://www.yiiframework.com/doc/guide/1.1/ru/topics.security#sec-4
        ],
        'session' => ['cookieParams' => ['httponly' => true]],
        // параметры логирования, подробнее http://www.yiiframework.ru/doc/guide/ru/topics.logging
        'log' => [
            'class' => 'CLogRouter',
            'routes' => [
                [
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning, info, trace, profile', // на продакшн лучше оставить error, warning
                ]
            ]
        ],
        'errorHandler' => [ // use 'site/error' action to display errors
            'errorAction' => 'site/error'
        ]
    ],
    'rules' => [ //подробнее http://websum.uz/docs/core/userspace.config.html
        '/site/captcha/refresh/<v>' => 'site/captcha/refresh',
        '/site/captcha/<v>'         => 'site/captcha/',
    ]
];
