<?php

use yii\grid\GridView;
?>
<?= GridView::widget([
    'options' => ['class'=>'reset-margin'],
    'summary'=>'',
    'emptyText' => '<p class="h4">Матчей не найдено</p>',
    'dataProvider' => $matches,
    'tableOptions' => ['class' => 'table table-bordered', /*'style'=>'margin-top: 30px;'*/],
    'headerRowOptions' => ['class' => 'bg-grey',],
    'columns' => [
        [
            'label' => 'Тур',
            'value'=>'n_tour',
        ],
        [
            'label' => 'Дата',
            'value' => function($model) {
                return  Yii::$app->formatter->asDate($model->date_match, 'php:Y.m.d');
            },
        ],
        [
            'label' => 'Время',
            'value' => function($model) {
                return  Yii::$app->formatter->asDate($model->date_match, 'php:H:i');
            },
        ],
        [
            'label' => 'Матч',
            'value' => function($model) {
                return $model->idHome->name_team .' - '. $model->idGuest->name_team;
            },
        ],
        [
            'label' => 'Счет',
            'value'=>function($model) {
                return $model->score_h .' : '. $model->score_g;
            }
        ],
    ],
]); ?>
