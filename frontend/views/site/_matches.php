<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

$columns = [
    [
        'format'=>'html', //render logo, name and city home team
        'value'=>function ($model) {
            if (is_null($model->id_home) /*|| is_null($model->id_guest)*/) {return false;}
            return Html::img(Yii::getAlias('@web').'/img/logo/'. $model->idHome->alias_team .'.png',['class'=>'img-responsive img-25', 'title' => $model->idHome->name_team, 'style' => 'max-height: 41px;width: auto;']).Html::tag('p',$model->idHome->name_team, ['class'=>'bold reset-margin text-nowrap', 'style' => 'min-height: 25px;']).'<p class="h6 reset-margin">('.$model->idHome->city.')</p>';
        },
        'contentOptions' => function($model) {
            if (is_null($model->id_home) /*|| is_null($model->id_guest)*/) {return ['style' => 'display: none;'];}        
            return ['class'=>'col-xs-5', 'style' => 'padding: 8px 0px'];
        },
    ],
    [
        'format'=>'html', //render score
        'value' => function($model) {
            if (is_null($model->id_home) || is_null($model->id_guest)) {
                return Html::tag('p', Yii::$app->formatter->asDate($model->date_match, 'php:d F, Y'), ['class'=>'h3 bold', 'style' => 'min-height: 25px;']).Html::tag('p',Yii::$app->formatter->asDate($model->date_match, 'php:H:i'), ['class'=>'bold', 'style' => 'min-height: 25px;']);
            }
            if (is_null($model->date_match) && !is_null($model->score_h)) { //a state of match is cancled
                return Html::tag('p', ($model->score_h > $model->score_g) ? '+ : -' : '- : +', ['class' => 'bold reset-margin']).Html::tag('p', '('.$model->score_h .' : '. $model->score_g.')', ['class' => 'bold']);
            } elseif ($model->id == 111) { //workaround Extra time and penalty render
                return Html::tag('span', $model->score_h .' : '. $model->score_g, ['class' => 'bold']).Html::tag('p', 'ДВ 2 : 2', ['style' => 'font-size: 14px; margin: 5px 0 0;']).Html::tag('p', 'пен. 6 : 5', ['style' => 'font-size: 14px; margin: 0;']);
            } else { //a state of match is willPlay, played or postponed
                return Html::tag('span', $model->score_h .' : '. $model->score_g, ['class' => 'bold']);
            }
        },
        'contentOptions' => function($model) {
            if (is_null($model->id_home) || is_null($model->id_guest)) {return ['class'=>'col-xs-12', 'style' => 'padding: 0'];}       
            return ['class'=>'col-xs-2', 'style' => 'padding: 0;'];
        },
    ],
    [
        'format'=>'html', //render logo, name and city guest team
        'value'=>function ($model) {
            if (/*is_null($model->id_home) || */is_null($model->id_guest)) {return false;}
            return Html::img(Yii::getAlias('@web').'/img/logo/'. $model->idGuest->alias_team .'.png',['class'=>'img-responsive img-25', 'title' => $model->idGuest->name_team, 'style' => 'max-height: 41px;width: auto;']).Html::tag('p',$model->idGuest->name_team, ['class'=>'bold reset-margin text-nowrap', 'style' => 'min-height: 25px;']).'<p class="h6 reset-margin">('.$model->idGuest->city.')</p>';
            },
        'contentOptions' => function($model) {
            if (is_null($model->id_home) || is_null($model->id_guest)) {return ['style' => 'display: none;'];}       
            return ['class'=>'col-xs-5', 'style' => 'padding: 8px 0px'];
        },
    ],
];
?>
<div class="subsection content-box col-xs-12 col-md-<?= (isset($tournament) ? 8 : 12) ?> bg-white">
    <header class="header-section">
        <?= Html::tag('h2', 'Календарь игр', ['class' => 'text-uppercase blue-text underline'])?>
        <?= Html::tag('p', $league->name, ['class' => 'h4 bold text-uppercase blue-text'])?>
    </header>
    <div class="reset-margin row carousel-matches" data-slick='{"slidesToShow": <?= (isset($tournament) ? 2 : 3)?>, "initialSlide": <?= $params['id_league'] == 4 ? 0 : $params['n_tour'] - 1 ?> }' style="height:auto;">
        <?php
        foreach($matches as $match):
            echo GridView::widget([
                'options' => ['class'=>'reset-margin', 'style' => 'padding: 0 15px;'],
                'summary'=>'',
                'beforeRow' => function($model) { //render paddings for playoff
                    if ($model->idLeague->type == 'play-off' && $model->n_tour > 1) {return '<tr style="height: '.($model->n_tour == 4 ? 225 : 75).'px;"></tr>';}
                },
                'afterRow' => function($model) {

		            if (is_null($model->id_home) || is_null($model->id_guest)) {return Html::tag('tr', null, ['style' => 'height: 75px;']);} 

                    /*
                    * If match is postponed, display the message
                    */
                    if ($model->postponed == 1) {

                        $after_row = 'Матч перенесен';

                    } elseif (!is_null($model->date_match)) {

                        $after_row = Html::tag('p', Yii::$app->formatter->asDate(
                            $model->date_match,
                            similar_text('0000-00-00 00:00', $model->date_match, $percent) != 11 ? 'php:d F, Y' : 'php:j F, Y | H:i'
                        ), ['class' => 'h5']);   
                        
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
                            ['class' => 'h2', 'style' => 'position: absolute; right: 30px; top: 50%; margin-top: -0.6em;']);
                        }    
                                         
                    }
                    
                    /*
                    * Wrap @after_row in the tag td then in the tag tr
                    */
                    $after_row = Html::tag('tr', Html::tag('td', $after_row, ['colspan' => 3, 'style' => 'position: relative; padding:0; border-top: 1px solid #ddd; border-bottom: 15px solid #ffffff;']));

                    /*
                    * Add the top margin if the match play-off of the tournament and the tour number is more than one and return result
                    */
                    if ($model->n_tour > 1 && $model->idLeague->type == 'play-off') {
                        return $after_row.Html::tag('tr', null, ['style' => 'height: 75px;']);
                    }

                    return $after_row;
                },
                'rowOptions' =>  function($model) {
		            if (is_null($model->id_home) || is_null($model->id_guest)) {return ['style' => 'border-bottom: 15px solid #ffffff; height: 150px;'];}
                },
                'showHeader' => false,
                'dataProvider' => $match,
                'tableOptions' => [
                    'class' => 'table list-item index-page',
                    'id' => 'table-list-match',
                    /*'style'=> 'table-layout: fixed;'*/
                ],
                'caption' => '<h3 class="text-uppercase bold">'.(isset($headers) ? $headers[($match->models[0]->n_tour - 1)] : $match->models[0]->n_tour . ' тур').'</h3>',
                'columns' => $columns,
            ]);
        endforeach;
        ?>
    </div>
    <footer class="footer-sub text-center">
        <a class="btn btn-primary btn-lg text-uppercase" href="#prev">Назад</a>
        <?= Html::a((isset($tournament) ? 'Календарь игр' : 'Перейти к турниру'), Url::to([
                    (isset($tournament) ? '/pages/results' : '/pages/tournament'),
                    'idLeague' => $params['id_league'],
                    'tour' => $params['n_tour'],
                    'season' => $params['id_season'],
                ]), ['class'=>'btn btn-primary btn-lg text-uppercase', 'style' => 'margin: 0 15px']);?>
        <a class="btn btn-primary btn-lg text-uppercase" href="#next">Вперед</a>
    </footer>
</div>

