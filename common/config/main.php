<?php
return [
    'language' => 'ru-RU',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'currentFootballData' => [
            'class' => 'common\components\CurrentFootballData',
        ],
        'media' => [
            'class' => 'common\components\Media',
            'fileStorageInterface' => 'common\helpers\FileHelper',
            'options' => [
                'directories' => [
                    'pictures' => [
                        'path' => '/img',
                        'findOptions' => [
                            'only' => ['gallery/*', 'events/*/*']
                        ]
                    ],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
    ],
];
