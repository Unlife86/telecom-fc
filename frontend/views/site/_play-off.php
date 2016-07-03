<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
//print_r($tours);

if ($league->id == 2) {
    $rounds = ['1/8 финала', '1/4 финала', 'Полуфинал', 'Финал'];
} else if ($league->id == 4) {
    $rounds = ['Полуфинал', 'за 3 место', 'Финал'];
}
?>
    <div class="subsection content-box col-xs-12 col-sm-12 col-md-8 bg-white">
        <div class="content">
            <h2 class="text-uppercase blue-text underline"><?= $league->name?></h2>
<?=  GridView::widget([
    'options' => ['class'=>'reset-margin'],
    'summary'=>'',
    'caption' => '<h3 class="text-uppercase bold reset-margin">'.$rounds[$tour-1].'</h3>',
    //'caption' => '<h3 class="text-uppercase bold reset-margin">'.$rounds[$tour-1].' (плей-офф)</h3>',
    //'captionOptions' => ['class' => 'reset-padding'],
    'dataProvider' => $tours,
    'tableOptions' => ['class' => 'table', 'style'=>'margin-top: 30px;'],
    'headerRowOptions' => ['class' => 'bg-grey',],
    'showHeader' => false,
    'columns' => [
        //['class' => 'yii\grid\SerialColumn'],
       /*[
            'value'=> function($model) {
                //return '<p class="bold reset-margin">'.$model->idHome->name_team.'</p><p class="h6 reset-margin">('.$model->idHome->city.')</p>';
                return Html::tag('p', $model->idHome->name_team,['class' => 'bold reset-margin']).Html::tag('p', $model->idHome->city,['class' => 'h6 reset-margin']);
            },
            'format'=>'html',
        ],*/
        [
            'value'=> function($model) {
                    return '<p class="reset-margin h4">'.date('d.m',strtotime($model->date_match)).'</p>';
            },
            'format'=>'html',
        ],
        [
            'value'=> function($model) {
                    if (Yii::$app->formatter->asDate($model->date_match, 'php:H') != '00') {
                        return '<p class="reset-margin h4">' . date('H:i', strtotime($model->date_match)) . '</p>';
                    } else {
                        return '<p class="reset-margin h4"></p>';
                    }
            },
            'format'=>'html',
        ],
        /*[
            'value'=> function($model) {
                $home = ['name' => '', 'city' => null]; $guest = ['name' => '', 'city' => null];
                if ($model->id_home != 0) {$home['name'] = $model->idHome->name_team; $home['city'] = $model->idHome->city;}
                if ($model->id_guest != 0) {$guest['name'] = $model->idGuest->name_team; $guest['city'] = $model->idGuest->city;}
                return '<p class="bold reset-margin">'.$home['name'].'</p><p class="h6 reset-margin" style="margin-bottom: 15px">('.$home['city'].')</p>'.'<p class="bold reset-margin">'.$guest['name'].'</p><p class="h6 reset-margin">('.$guest['city'].')</p>';
                //return Html::tag('p', $model->idHome->name_team,['class' => 'bold reset-margin']).Html::tag('span', $model->idHome->city,['class' => 'h6', 'style' => 'top: -10px; position: relative;']).Html::tag('p', $model->idGuest->name_team,['class' => 'bold reset-margin', 'style' => 'bottom: -10px; position: relative;']).Html::tag('span', $model->idGuest->city,['class' => 'h6']);
            },
            'format'=>'html',
        ],*/
        [
            'value'=> function($model) {
                $home = ['name' => '', 'city' => null];
                if ($model->id_home != 0) {$home['name'] = $model->idHome->name_team; $home['city'] = $model->idHome->city;}
                return '<p class="bold reset-margin">'.$home['name'].'</p><p class="h6 reset-margin">('.$home['city'].')</p>';
            },
            'format'=>'html',
        ],
        [
            'value'=> function($model) {
                return '<p class="reset-margin h4">'.$model->score_h.' : '.$model->score_g.'</p>';
            },
            'format'=>'html',
            //'contentOptions' => ['class' => 'bold'],
        ],
        [
            'value'=> function($model) {
                $guest = ['name' => '', 'city' => null];
                if ($model->id_guest != 0) {$guest['name'] = $model->idGuest->name_team; $guest['city'] = $model->idGuest->city;}
                return '<p class="bold reset-margin">'.$guest['name'].'</p><p class="h6 reset-margin">('.$guest['city'].')</p>';
            },
            'format'=>'html',
        ],

        /*[
            'value'=> function($model) {
                    if (strlen($model->score_h) == 0) {
                        if (Yii::$app->formatter->asDate($model->date_match, 'php:H') == '00') {
                            return '<p class="reset-margin h3">'.date('d.m',strtotime($model->date_match)).'</p>';
                        } else {
                            return '<p class="reset-margin h3">'.date('d.m',strtotime($model->date_match)).'</p>'.'<p class="reset-margin">'.date('H:i',strtotime($model->date_match)).'</p>';
                        }
                    } else {
                        return '<p class="reset-margin h3">'.$model->score_h.' : '.$model->score_g.'</p>';
                    }


            },
            'format'=>'html',
            //'contentOptions' => ['class' => 'bold'],
        ],*/
        /*[
            'value'=> function($model) {
                return '<strong>'.$model->idHome->name_team.'</strong><p class="h6 reset-margin">('.$model->idHome->city.')</p>';
            },
            'format'=>'html',
        ],
        [
            'value'=> function($model) {
                return '<strong>'.$model->idGuest->name_team.'</strong><p class="h6 reset-margin">('.$model->idGuest->city.')</p>';
            },
            'format'=>'html',
        ],*/
    ],
]); ?>

