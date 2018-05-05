<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

$allowIPs = [
    '31.40.98.185',
    '87.245.184.66',
];

if (in_array($_SERVER['REMOTE_ADDR'], $allowIPs) || !empty($_COOKIE['_identity']) || 1 > 0) {
    try {
        (new yii\web\Application($config))->run();
    } catch (\yii\base\InvalidConfigException $e) {
        $e->getMessage();
    }
} else {
    echo 'Доступ ограничен!';
}
