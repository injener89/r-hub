<?php

// Определяем алиасы:
Yii::setPathOfAlias('application', dirname(__FILE__) . '/../');
Yii::setPathOfAlias('public', dirname($_SERVER['SCRIPT_FILENAME']));
Yii::setPathOfAlias('core', dirname(__FILE__) . '/../modules/core/');
Yii::setPathOfAlias('vendor', dirname(__FILE__) . '/../../vendor/');

return CMap::mergeArray(
    require(dirname(__FILE__) . '/main.php'),
    [
        'import'     => [
            'application.components.*',
            'application.models.*',
            'application.modules.core.models.*',
            'application.modules.core.components.*',
            'application.modules.core.controllers.*',
            'application.modules.core.components.controllers.*',
            'application.modules.core.extensions.tagcache.*',
            'application.modules.core.widgets.*',
        ],
        'components' => [
            'bootstrap'    => [
                'class'          => 'bootstrap.components.Booster',
                'responsiveCss'  => true,
                'fontAwesomeCss' => true,
            ],
            // Работа с миграциями, обновление БД модулей
            'migrator'     => ['class' => 'core\components\Migrator',],
            // параметры подключения к базе данных, подробнее http://www.yiiframework.ru/doc/guide/ru/database.overview
            // используется лишь после установки Юпи для тестирования:
            'db'           => file_exists(__DIR__ . '/db-test.php') ? require_once __DIR__ . '/db-test.php' : [],
            'themeManager' => ['basePath' => dirname(__DIR__) . '/../themes',],
            'cache'        => [
                'class'     => 'CFileCache',
                'behaviors' => ['clear' => ['class' => 'application.modules.core.extensions.tagcache.TaggingCacheBehavior',],],
            ],
            'fixture'      => ['class' => 'system.test.CDbFixtureManager',],
            // конфигурирование urlManager, подробнее: http://www.yiiframework.ru/doc/guide/ru/topics.url
            'urlManager'   => [
                'class'            => 'core\components\urlManager\LangUrlManager',
                'languageInPath'   => true,
                'langParam'        => 'language',
                'urlFormat'        => 'path',
                'showScriptName'   => true,
                // чтобы убрать index.php из url, читаем: http://yiiframework.ru/doc/guide/ru/quickstart.apache-nginx-config
                'cacheID'          => 'cache',
                'useStrictParsing' => true,
                'rules'            => [ // общие правила
                    '/'                                                            => 'install/default/index',
                    '/backend'                                                     => 'core/backend/index',
                    '/backend/<action:\w+>'                                        => 'core/backend/<action>',
                    '/backend/<module:\w+>/<controller:\w+>'                       => '<module>/<controller>Backend/index',
                    '/backend/<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<module>/<controller>Backend/<action>',
                    '/backend/<module:\w+>/<controller:\w+>/<action:\w+>'          => '<module>/<controller>Backend/<action>',
                ]
            ],
        ],
    ]
);
