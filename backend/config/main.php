<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'language' => 'ru-RU',
    'timeZone' => 'UTC',
    'bootstrap' => ['log'],
    'modules' => [
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ],
        'markdown' => [
		    'class' => 'kartik\markdown\Module',
            'previewAction' => '/markdown/parse/preview',
        ]
    ],
    'components' => [
    ],
    'container' => [
        'definitions' => [
            'dmstr\widgets\Menu' => [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Меню сайта', 'options' => ['class' => 'header']],
                    ['label' => 'Турнирная таблица', 'url' => ['/tournament/index', 'idLeague' => 1, 'tour' => 14, 'season' => 3]],
                    ['label' => 'Матчи', 'url' => ['/matches/index', 'idLeague' => 1, 'tour' => 14, 'season' => 3]],
                    ['label' => 'Новости', 'url' => ['/news/index']],
                    ['label' => 'Медиа', 'url' => ['/media/index']],
                    ['label' => 'Инструменты', 'icon' => 'share', 'url' => '#', 'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                        ],
                    ],
                ]
            ]
        ],
    ],
    'params' => $params,
];
