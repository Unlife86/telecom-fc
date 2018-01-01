<?php

use yii\helpers\Html;
use yii\widgets\ListView;

?>
<div class="panel panel-default bg-75">
    <div class="panel-heading text-uppercase text-center bg-blue">
        <?= Html::tag('h4', $header, ['class' => 'text-uppercase white-text']) ?> 
    </div>

    <?= ListView::widget([
        'dataProvider' => $model,
        'summary'=>'',
        'itemOptions' => ['class'=>'panel-body text-center', 'style' => 'padding: 15px 0px;'],
        'itemView' => function($model) {
            $score = Html::tag('p',$model->score_h.' : '.$model->score_g,['class' => 'bold h3', 'style' => 'padding-top: 20px;']);
            $home = Html::img(Yii::getAlias('@web').'/img/logo/'. $model->idHome->alias_team .'.png',['class'=>'img-responsive']).Html::tag('p', $model->idHome->name_team/*.'<p class="h6 nowrap">('.$model->idHome->city.')</p>'*/, ['class' => 'h5 text-uppercase reset-margin bold nowrap']);
            $guest = Html::img(Yii::getAlias('@web').'/img/logo/'. $model->idGuest->alias_team .'.png',['class'=>'img-responsive']).Html::tag('p', $model->idGuest->name_team/*.'<p class="h6 nowrap">('.$model->idGuest->city.')</p>'*/, ['class' => 'h5 text-uppercase reset-margin bold nowrap']);
            $label = Html::tag('div',$home,['class' => 'col-xs-4']).Html::tag('div',$score,['class' => 'col-xs-4 reset-padding']).Html::tag('div',$guest,['class' => 'col-xs-4']);
            return $label;

        },
    ]); ?>

    <div class="panel-footer">
        <?= ListView::widget([
            'dataProvider' => $model,
            'summary'=>'',
            'itemView' => function($model) {
                $stadium = ( !is_null($model->id_stadium) ? Html::tag('p', 'Стадион «'.$model->idStadium->name.'»', ['class' => 'text-center']).Html::tag('p','г. '.$model->idStadium->city, ['class' => 'text-center']) : null);
                return $stadium;

            },
        ]); ?>
    </div>
</div>

