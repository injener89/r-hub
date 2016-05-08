<?php
Yii::setPathOfAlias('application', __DIR__ . '/../');
Yii::setPathOfAlias('core', __DIR__ . '/../modules/core/');
Yii::setPathOfAlias('vendor', __DIR__ . '/../../vendor/');
Yii::setPathOfAlias('themes', __DIR__ . '/../../themes/');

return [
    // У вас этот путь может отличаться. Можно подсмотреть в config/main.php.
    'basePath' => dirname(__DIR__),
    'name' => 'Cron',
    'preload' => ['log'],
    'commandMap' => [
        'migrate' => [
            'class' => 'vendor.yiiext.migrate-command.EMigrateCommand',
            'migrationPath' => 'application.modules.core.install.migrations',
            'migrationTable' => '{{migrations}}',
            'applicationModuleName' => 'core',
            'migrationSubPath' => 'install.migrations',
            'connectionID'=>'db',
        ],
    ],
    'import' => [
        'application.commands.*',
        'application.components.*',
        'application.models.*',
    ],
    'aliases' => [
        'webroot' => dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'public',
    ],
    // Перенаправляем журнал для cron-а в отдельные файлы
    'components' => [
        'moduleManager' => ['class' => 'core\components\ModuleManager'],
        'configManager' => ['class' => 'core\components\ConfigManager'],
        // Работа с миграциями, обновление БД модулей
        'migrator' => ['class' => 'core\components\Migrator'],
        'themeManager' => [
            'class' => 'CThemeManager',
            'basePath' => dirname(__DIR__) . '/../themes',
            'themeClass' => 'core\components\Theme'
        ],
        'request' => [
            'class' => 'core\components\HttpRequest',
            'enableCsrfValidation' => true,
            'csrfCookie' => ['httpOnly' => true],
            'csrfTokenName' => 'CORE_TOKEN',
            'enableCookieValidation' => true,
            // подробнее: http://www.yiiframework.com/doc/guide/1.1/ru/topics.security#sec-4
        ],
        // компонент для отправки почты
        'mail' => [
            'class' => 'core\components\Mail',
        ],
        'log' => [
            'class' => 'CLogRouter',
            'routes' => [
                [
                    'class' => 'CFileLogRoute',
                    'logFile' => 'cron.log',
                    'levels' => 'error, warning, info',
                ],
                [
                    'class' => 'CFileLogRoute',
                    'logFile' => 'cron_trace.log',
                    'levels' => 'trace',
                ],
            ],
        ],
        'cache' => [
            'class' => 'CDummyCache',
            'behaviors' => [
                'clear' => [
                    'class' => 'TaggingCacheBehavior',
                ],
            ],
        ],
        // параметры подключения к базе данных, подробнее http://www.yiiframework.ru/doc/guide/ru/database.overview
        'db' => file_exists(__DIR__ . '/db.php') ? require_once __DIR__ . '/db.php' : []
    ],
    'modules' => ['core' => ['class' => 'application.modules.core.CoreModule', 'cache' => true,],]
];
