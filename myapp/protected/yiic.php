<?php
require dirname(__FILE__) . '/../vendor/autoload.php';
$yiic = require dirname(__FILE__) . '/../vendor/yiisoft/yii/framework/yii.php';

$config = require dirname(__FILE__) . '/config/console.php';
$configManager = new core\components\ConfigManager();
$configManager->sentEnv(\core\components\ConfigManager::ENV_CONSOLE);

$app = \Yii::createConsoleApplication($configManager->merge($config));
$app->commandRunner->addCommands(YII_PATH . '/cli/commands');
$app->run();
