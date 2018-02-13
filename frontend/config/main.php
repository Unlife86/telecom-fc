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
        'assetManager' => [
            'bundles' => [
                'common\assets\AppAsset' => [
                    'js' => [
                        'http://code.jquery.com/jquery-migrate-1.2.1.min.js',
                        'js/slick.min.js',
                        'js/timer/jquery.plugin.js',
                        'js/plugins.js',
                        'js/main.js',
                    ],
                    'css' => [
                        'css/main.css',
                        'css/slick.css',
                        'css/slick-theme.css',
                    ],
                    'depends' => [
                        'yii\web\YiiAsset',
                        'yii\bootstrap\BootstrapAsset',
                        'sersid\fontawesome\Asset',
                        'frontend\assets\HeadAsset'
                    ]
                ],
            ],
        ],
    ],
    'container' => [
        'definitions' => [
            'yii\bootstrap\Nav' => [
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
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
                ],
                'dropDownCaret' => '',
                'activateParents'=> true,
                'on beforeRun' => function ($event) {
                    if (in_array(Yii::$app->request->userIP, Yii::$app->params['allowedIPs'])) {
                        $event->sender->items[] = ['label' => 'Управление сайтом', 'url' => 'http://backend.telecom-fc.ru'];
                    }
                    foreach($event->sender->items as $key => $item):
                        $event->sender->items[$key] = array_merge($item, ['linkOptions' => ['class' => 'text-uppercase black-text']]);
                    endforeach;
                },
            ],
            'yii\bootstrap\NavBar' => [
                'screenReaderToggleText' => 'Меню сайта',
                'innerContainerOptions' => ['class' => 'row bg-white'],
                'options' => ['class' => 'col-xs-12 general reset-margin'],
            ],
            'frontend\controllers\PagesController' => [
                'layout' => 'main-not-index'
            ],
            'frontend\controllers\TeamController' => [
                'layout' => 'main-not-index'
            ],
        ],
    ],
    'params' => $params,
];
