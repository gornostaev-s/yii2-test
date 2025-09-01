<?php

use common\interfaces\SendMessageInterface;
use common\providers\smsPilot\SmsPilotClient;
use yii\rbac\DbManager;
use yii\rbac\ManagerInterface;

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'container' => [
        'definitions' => [
            ManagerInterface::class => DbManager::class,
            SendMessageInterface::class => SmsPilotClient::class
        ]
    ],
    'components' => [
        'authManager' => [
            'class' => ManagerInterface::class,
            'cache' => 'cache',
        ],
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
        'db' => [
            'class' => \yii\db\Connection::class,
            'dsn' => env('MYSQL_DSN'),
            'username' => env('MYSQL_USER'),
            'password' => env('MYSQL_PASSWORD'),
            'charset' => 'utf8',
        ],
    ],
];
