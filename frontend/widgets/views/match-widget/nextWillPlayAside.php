<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\widgets\ListView;
?>
<div class="panel panel-default bg-75">
        <div class="panel-heading text-uppercase text-center bg-blue">
            <?= Html::tag('h4', $header, ['class' => 'text-uppercase white-text']) ?>
        </div>

    <?= ListView::widget([
        'dataProvider' => $model,
        'summary'=>'',
        'itemOptions' => ['class'=>'panel-body'],
        'itemView' => function($model) {
            $home = '<div class="col-xs-6 text-center reset-padding">'.Html::img(Yii::getAlias('@web').'/img/logo/'. $model->idHome->alias_team .'.png',['class'=>'img-responsive']).'<p class="h5 text-uppercase bold reset-margin">'.$model->idHome->name_team.'</p><p class="h6 reset-margin">('.$model->idHome->city.')</p></div>';
            $guest = '<div class="col-xs-6 text-center reset-padding">'.Html::img(Yii::getAlias('@web').'/img/logo/'. $model->idGuest->alias_team .'.png',['class'=>'img-responsive']).'<p class="h5 text-uppercase bold reset-margin">'.$model->idGuest->name_team.'</p><p class="h6 reset-margin">('.$model->idGuest->city.')</p></div>';
            return $home.$guest;

        },
    ]); ?>
        <?= ListView::widget([
            'dataProvider' => $model,
            'summary'=>'',
            'itemView' => function($model) {
                $address = Html::tag('p', $model->date_match, ['class' => 'text-center h4']);
                if ($model->id_stadium != 0) {
                    $stadium = Html::tag('p', 'Стадион «'.$model->idStadium->name.'», г. '.$model->idStadium->city, ['class' => 'text-center reset-margin']);
                    return $address.$stadium;
                }
                return $address;



            },
        ]); ?>
    <div class="panel-footer">
        <div id="clock"></div>
    </div>
</div>
