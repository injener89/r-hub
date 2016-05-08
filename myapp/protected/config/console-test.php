<?php
Yii::setPathOfAlias('application', dirname(__FILE__) . '/../');
Yii::setPathOfAlias('core', dirname(__FILE__) . '/../modules/core/');
Yii::setPathOfAlias('vendor', dirname(__FILE__) . '/../../vendor/');

return [
    // У вас этот путь может отличаться. Можно подсмотреть в config/main.php.
    'basePath'   => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name'       => 'Cron',
    'preload'    => ['log'],
    'commandMap' => [],
    'import'     => [
        'application.commands.*',
        'application.components.*',
        'application.models.*',
        'application.modules.queue.models.*',
        'application.modules.core.extensions.tagcache.*',
    ],
    'modules'    => [
        'comment' => ['class' => 'application.modules.comment.CommentModule',],
        'core'    => ['class' => 'application.modules.core.CoreModule',]
    ],
    // Перенаправляем журнал для cron-а в отдельные файлы
    'components' => [
        // компонент для отправки почты
        'mail'     => [
            'class' => 'core\components\Mail',
        ],
        'migrator' => [
            'class' => 'core\components\Migrator',
        ],
        'log'      => [
            'class'  => 'CLogRouter',
            'routes' => [
                [
                    'class'   => 'CFileLogRoute',
                    'logFile' => 'cron.log',
                    'levels'  => 'error, warning, info',
                ],
                [
                    'class'   => 'CFileLogRoute',
                    'logFile' => 'cron_trace.log',
                    'levels'  => 'trace',
                ],
            ],
        ],
        'cache'    => [
            'class'     => 'CDummyCache',
            'behaviors' => [
                'clear' => [
                    'class' => 'TaggingCacheBehavior',
                ],
            ],
        ],
        // параметры подключения к базе данных, подробнее http://www.yiiframework.ru/doc/guide/ru/database.overview
        'db'       => file_exists(__DIR__ . '/db-test.php') ? require_once __DIR__ . '/db-test.php' : [],
    ],
];
