<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'language' => 'ru-RU',
    'bootstrap' => ['log'],
    'timeZone' => 'UTC',
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'currentFootballData' => [
            'class' => 'common\components\CurrentFootballData',
        ],
        'urlManager' => [
            /*'enablePrettyUrl' => true,
            'showScriptName' => false,*/
            'rules' => [
            ],
        ],
    ],
    'container' => [
        'definitions' => [
            'common\widgets\HeaderSite' => [
                'menuItems' => [
                    ['label' => 'Главная', 'url' => ['/site/index']],
                    ['label' => 'Клуб', 'url' => ['#'], 'items' => [
                        ['label' => 'Статистика', 'url' => ['/pages/static']],
                        ['label' => 'События', 'url' => ['/team/events']],
                        ['label' => 'Медиа', 'url' => ['/pages/gallery']],
                        ['label' => 'Контакты', 'url' => ['/pages/contacts']],
                    ]],
                    ['label' => 'Первенство Лиги', 'url' => ['/pages/tournament', 'idLeague' => 1, 'tour' => 14, 'season' => 3]],
                    ['label' => 'Кубок Лиги', 'url' => ['/pages/tournament', 'idLeague' => 2, 'tour' => 4, 'season' => 3]],
                    ['label' => 'Весенний кубок', 'url' => ['/pages/tournament', 'idLeague' => 4, 'tour' => 3, 'season' => 3]],
                    ['label' => 'Футбольная лига Кузбасса', 'url' => 'http://ligafutbola42.ucoz.ru'],
                    in_array(Yii::$app->request->userIP, $params['allowedIPs']) ? ['label' => 'Футбольная лига Кузбасса', 'url' => 'http://ligafutbola42.ucoz.ru'] : null,
                ]
            ]
        ],
    ],
    'params' => $params,
];
