<?php
/**
 * Входной скрипт index:
 *
 * @category CoreScript
 * @package  CoreCMS
 * @author   Core Team <team@websum.uz>
 * @license  https://github.com/core/core/blob/master/LICENSE BSD
 * @link     http://websum.uz
 **/
// подробнее про index.php http://www.yiiframework.ru/doc/guide/ru/basics.entry
if (!ini_get('date.timezone')) {
    date_default_timezone_set('Europe/Moscow');
}

// Setting internal encoding to UTF-8.
if (!ini_get('mbstring.internal_encoding')) {
    @ini_set("mbstring.internal_encoding", 'UTF-8');
    mb_internal_encoding('UTF-8');
}

// две строки закомментировать на продакшн сервере
//define('YII_DEBUG', true);
//defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

require __DIR__ . '/vendor/yiisoft/yii/framework/yii.php';

$base = require __DIR__ . '/protected/config/main.php';

$confManager = new core\components\ConfigManager();
$confManager->sentEnv(\core\components\ConfigManager::ENV_WEB);

require __DIR__ . '/vendor/autoload.php';

Yii::createWebApplication($confManager->merge($base))->run();
