<?php

use yii\helpers\Html;
use yii\grid\GridView;

$columns = [
    [
        'format'=>'html',
        'value'=> function($model) { //render name and city home team, if set team and date of match or match is postponed
            if (!is_null($model->id_home) && ((!is_null($model->date_match))  || ($model->postponed == 1))) {
                return Html::tag('p',$model->idHome->name_team, ['class'=>'bold reset-margin']).Html::tag('p',$model->idHome->city, ['class'=>'h6 reset-margin']);
            }
        },
        'contentOptions' => ['class'=>'col-xs-4'],
    ],
    [
        'format' => 'html', //render logo home team, if set team and date of match or match is postponed
        'value' => function ($model) {
            if (!is_null($model->id_home) && ((!is_null($model->date_match)) || ($model->postponed == 1))) {
                return Html::img(Yii::getAlias('@web').'/img/logo/'. $model->idHome->alias_team .'.png',['class'=>'img-responsive', 'style' => 'max-height: 77.86px;width: auto;']);
            }
        },
        'contentOptions' => ['class'=>'col-xs-1 logo'],
    ],
    [
        'format'=>'html', //render score
        'value' => function($model) {
            if (is_null($model->date_match) && !is_null($model->score_h)) { //a state of match is cancled
                return Html::tag('p', ($model->score_h > $model->score_g) ? '+ : -' : '- : +', ['class' => 'bold reset-margin']).Html::tag('p', '('.$model->score_h .' : '. $model->score_g.')', ['class' => 'bold']);
            } elseif ($model->id == 111) { //workaround Extra time and penalty render
                return Html::tag('span', $model->score_h .' : '. $model->score_g, ['class' => 'bold']).Html::tag('p', 'ДВ 2 : 2', ['style' => 'font-size: 14px; margin: 5px 0 0;']).Html::tag('p', 'пен. 6 : 5', ['style' => 'font-size: 14px; margin: 0;']);
            } else { //a state of match is willPlay, played or postponed
                return Html::tag('span', $model->score_h .' : '. $model->score_g, ['class' => 'bold']);
            }
        },
        'contentOptions' => ['class'=>'col-xs-2'],
    ],
    [
        'format'=>'html', //render logo guest team, if set team and date of match or match is postponed
        'value'=>function ($model) {
            if (!is_null($model->id_guest) && ((!is_null($model->date_match)) || ($model->postponed == 1))) {
                return Html::img(Yii::getAlias('@web').'/img/logo/'. $model->idGuest->alias_team .'.png',['class'=>'img-responsive', 'style' => 'max-height: 77.86px;width: auto;']);
            }
        },
        'contentOptions' => ['class'=>'col-xs-1 logo'],
    ],
    [
        'format'=>'html', //render name and city guest team, if set team and date of match or match is postponed
        'value'=> function($model) {
            if (!is_null($model->id_guest) && ((!is_null($model->date_match)) || ($model->postponed == 1))) {
                return Html::tag('p',$model->idGuest->name_team, ['class'=>'bold reset-margin']).Html::tag('p',$model->idGuest->city, ['class'=>'h6 reset-margin']);
            }
        },
        'contentOptions' => ['class'=>'col-xs-4'],
    ],
];

?>
<?= GridView::widget([
    'options' => ['class'=>'reset-margin'],
    'afterRow' => function($model) { //render date, stadium or state of match 

        if (is_null($model->id_home) || is_null($model->id_guest)) { return false; }

        if ($model->postponed == 1) {

            $after_row = 'Матч перенесен';

        } else {

            $after_row = Html::tag('p', Yii::$app->formatter->asDate(
                $model->date_match,
                similar_text('0000-00-00 00:00', $model->date_match, $percent) != 11 ? 'php:d F, Y' : 'php:j F, Y | H:i'
            ), ['class' => 'h4 text-center bold']); 

            /*
            * Add stadium name and city if it is given
            */
            if (!is_null($model->id_stadium)) {
                $after_row = $after_row.Html::tag('p', 'Стадион «'.$model->idStadium->name.'», г. '.$model->idStadium->city, ['class' => 'h5 text-center', 'style' => 'margin-top: 5px']);
            }

            /*
            * Add the button for launching the YouTube video player in the model window, if the match has it. Only a played matches
            */
            if (!is_null($model->idReviewVideo)) {
                $after_row = $after_row.Html::tag('p', 
                    Html::tag('i', null, [
                        'class' => 'fa fa-youtube-play video-modal', 
                        'aria-hidden' => true, 
                        'data-link' => $model->idReviewVideo->url,
                        'data-toggle' => 'modal', 
                        'data-target'=> '#imgModal', 
                        'style' => 'color: #E62117; cursor: pointer;'
                    ]), 
                ['class' => 'h1', 'style' => 'position: absolute; right: 30px; top: 50%; margin-top: -0.6em;']);
            } 

        } 

        /*
        * Wrap @after_row in the tag td then in the tag tr
        */
        return Html::tag('tr', Html::tag('td', $after_row, ['colspan' => 5, 'style' => 'position: relative; padding:0; border-top: 1px solid #ddd; border-bottom: 15px solid #ffffff;']));

    },
    'rowOptions' =>  function($model) {
        if (is_null($model->date_match) && !is_null($model->score_h)) {
            return $options = ['style' => 'border-bottom: 15px solid #ffffff'];
        }   
        return false;
    },
    'caption' => '<h3 class="text-uppercase">'.$caption.'</h3>',
    'summary'=>'',
    'emptyText' => '<p class="h4">Матчей не найдено</p>',
    'dataProvider' => $dataProvider,
    'tableOptions' => ['class' => 'table list-item', 'id' => 'table-list-match', 'style'=>'table-layout: fixed; margin-top: 0;'],
    'showHeader' => false,
    'columns' => $columns,
]); ?>
