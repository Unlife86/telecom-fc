<?php

use yii\helpers\Html;
use yii\grid\GridView;

?>
<?= GridView::widget([
    'options' => ['class'=>'reset-margin'],
    'caption' => '<h3 class="text-uppercase">'.$caption.'</h3>',
    'summary'=>'',
    'emptyText' => '<p class="h4">Матчей не найдено</p>',
    'dataProvider' => $dataProvider,
    'tableOptions' => ['class' => 'table list-item', 'id' => 'table-list-match', 'style'=>'table-layout: fixed; margin-top: 0;'],
    'showHeader' => false,
    'columns' => [
        [
            'format'=>'html',
            'value'=>function ($model) {
                if (Yii::$app->formatter->asDate($model->date_match, 'php:H') == '00') {
                    return Html::tag('p', Yii::$app->formatter->asDate($model->date_match, 'php:d.m'),['class'=> 'countdown-period']);
                } else if (!empty($model->date_match)) {
                    return Html::tag('p', Yii::$app->formatter->asDate($model->date_match, 'php:d.m'),['class'=> 'countdown-period'])/*.Html::tag('p', date('d',strtotime($model->date_match)),['class'=> 'countdown-amount bg-black white-text'])*/.Html::tag('p', Yii::$app->formatter->asDate($model->date_match, 'php:H:i'),['class'=> 'bg-black white-text']);
                }
            },
            'contentOptions' => ['style' => 'font-size: 16px; width: 80px;'],
        ],
        [
            'format'=>'html',
            'value'=> function($model) {
                if (($model->id_home != 0) and (!empty($model->date_match))) {
                    return '<strong>'.$model->idHome->name_team.'</strong><p class="h6 reset-margin">('.$model->idHome->city.')</p>';
                } else {
                   return '';
                }


            },
            'contentOptions' => ['class'=>'col-xs-4'],
        ],
        [
            'format'=>'html',
            'value'=>function ($model) {
                if (($model->id_home != 0) and (!empty($model->date_match))) {
                    return Html::img(Yii::getAlias('@web').'/img/logo/'. $model->idHome->alias_team .'.png',['class'=>'img-responsive']);
                } else {
                    return '';
                }

            },
            'contentOptions' => ['class'=>'col-xs-1 logo'],
        ],
        [
            'value' => function($model) {
                if (!empty($model->date_match)) {
                    return $model->score_h .' : '. $model->score_g;
                }

            },
            'contentOptions' => ['class'=>'col-xs-2'],
        ],
        [
            'format'=>'html',
            'value'=>function ($model) {
                if (($model->id_guest != 0) and (!empty($model->date_match))) {
                    return Html::img(Yii::getAlias('@web').'/img/logo/'. $model->idGuest->alias_team .'.png',['class'=>'img-responsive']);
                } else {
                    return '';
                }
            },
            'contentOptions' => ['class'=>'col-xs-1 logo'],
        ],
        [
            'format'=>'html',
            'value'=> function($model) {
                if (($model->id_guest != 0) and (!empty($model->date_match))) {
                    return '<strong>'.$model->idGuest->name_team.'</strong><p class="h6 reset-margin">('.$model->idGuest->city.')</p>';
                } else {
                    return '';
                }
            },
            'contentOptions' => ['class'=>'col-xs-4'],
        ],

    ],
]); ?>
