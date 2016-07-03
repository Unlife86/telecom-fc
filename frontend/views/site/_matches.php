<?php

use yii\helpers\Html;
use yii\grid\GridView;

?>
<?= GridView::widget([
    'options' => ['class'=>'reset-margin'],
    'summary'=>'',
    'dataProvider' => $matches,
    'tableOptions' => ['class' => 'table list-item index-page', 'id' => 'table-list-match', 'style'=>'table-layout: fixed;'],
    'showHeader' => false,
    'columns' => [
        [
            'format'=>'html',
            'value'=>function ($model) {
                if (Yii::$app->formatter->asDate($model->date_match, 'php:H') == '00') {
                    return Html::tag('p', Yii::$app->formatter->asDate($model->date_match, 'php:d.m'),['class'=> 'countdown-period']);
                } else {
                    return Html::tag('p', Yii::$app->formatter->asDate($model->date_match, 'php:d.m'),['class'=> 'countdown-period'])/*.Html::tag('p', date('d',strtotime($model->date_match)),['class'=> 'countdown-amount bg-black white-text'])*/.Html::tag('p', Yii::$app->formatter->asDate($model->date_match, 'php:H:i'),['class'=> 'bg-black white-text']);
                }
            },
            'contentOptions' => ['class'=>'col-xs-3'],
        ],
        [
            'format'=>'html',
            'value'=>function ($model) {
                return Html::img(Yii::getAlias('@web').'/img/logo/'. $model->idHome->alias_team .'.png',['class'=>'img-responsive', 'title' => $model->idHome->name_team]);
            },
            'contentOptions' => ['class'=>'col-xs-3'],
        ],
        [
            'value' => function($model) {
                return $model->score_h .' : '. $model->score_g;
            },
            'contentOptions' => ['class'=>'col-xs-3'],
        ],
        [
            'format'=>'html',
            'value'=>function ($model) {
                return Html::img(Yii::getAlias('@web').'/img/logo/'. $model->idGuest->alias_team .'.png',['class'=>'img-responsive', 'title' => $model->idGuest->name_team]);
            },
            'contentOptions' => ['class'=>'col-xs-3'],
        ],
    ],
]); ?>

