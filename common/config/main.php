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
    'bootstrap' => [
        'queueSubscribers',
    ],
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
        'queueSubscribers' => [
            'class' => \yii\queue\redis\Queue::class,
            'redis' => 'redis', // Компонент подключения к Redis или его конфиг
            'channel' => 'queueSubscribers', // Ключ канала очереди
            'as log' => \yii\queue\LogBehavior::class
        ],
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => 'redis', // or your Redis host
        ],
    ],
];
