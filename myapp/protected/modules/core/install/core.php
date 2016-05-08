<?php

/**
 * Файл конфигурации модуля
 *
 * @category CoreMigration
 * @package  core.modules.user.install
 * @author   CoreTeam <team@websum.uz>
 * @license  BSD https://raw.github.com/core/core/master/LICENSE
 * @link     http://websum.uz
 **/

return [
    'import' => [
        'application.modules.core.components.validators.*',
        'application.modules.core.components.exceptions.*',
        'application.modules.core.extensions.tagcache.*',
        'application.modules.core.helpers.*',
        'application.modules.core.models.*',
        'application.modules.core.widgets.*',
        'application.modules.core.controllers.*',
        'application.modules.core.components.*',
    ],
    'preload' => ['log'],
    'component' => [
        // Массив компонентов, которые требует данный модуль
        // настройки кэширования, подробнее http://www.yiiframework.ru/doc/guide/ru/caching.overview
        // конфигурирование memcache в юпи http://websum.uz/docs/memcached.html
        'cache' => [
            'class' => 'CFileCache',
            'behaviors' => [
                'clear' => [
                    'class' => 'application.modules.core.extensions.tagcache.TaggingCacheBehavior',
                ],
            ],
        ],

        // DAO simple wrapper:
        'dao' => ['class' => 'core\components\DAO'],
        'thumbnailer' => ['class' => 'core\components\image\Thumbnailer'],
        // подключение компонента для генерации ajax-ответов
        'ajax' => ['class' => 'core\components\AsyncResponse']
    ],
    'rules'     => [],
    'module'    => [
    'components' => [
        'bootstrap' => [
            'class' => 'vendor.clevertech.yii-booster.src.components.Booster',
            'coreCss' => true,
            'responsiveCss' => true,
            'yiiCss' => true,
            'jqueryCss' => true,
            'enableJS' => true,
            'fontAwesomeCss' => true,
            'enableNotifierJS' => false,
        ],
    ],
    'visualEditors' => [
        'redactor' => [
            'class' => 'core\widgets\editors\Redactor',
        ],
        'ckeditor' => [
            'class' => 'core\widgets\editors\CKEditor',
        ],
        'textarea' => [
            'class' => 'core\widgets\editors\Textarea',
        ],
    ],
]
    ,
    'commandMap' => [
    'core' => [
        'class' => 'application.modules.core.commands.CoreCommand',
    ],
    'testenv' => [
        'class' => 'application.modules.core.commands.TestEnvCommand'
    ]
]
];
