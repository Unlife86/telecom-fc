<?php

use yii\helpers\Html;
use yii\widgets\ListView;
?>
<div class="panel panel-default bg-75">
    <div class="panel-heading text-uppercase text-center bg-blue">
        <h4 class="text-uppercase white-text">Последний результат</h4>
    </div>

    <?= ListView::widget([
        'dataProvider' => Yii::$app->currentFootballData->getNextMatchProvider(),
        'summary'=>'',
        'itemOptions' => ['class'=>'panel-body text-center', 'style' => 'padding: 15px 0px;'],
        'itemView' => function($model) {
            //$h_logo = Html::img(Yii::getAlias('@web').'/img/logo/'. $model->idHome->alias_team .'.png',['class'=>'img-responsive']); $g_logo = Html::img(Yii::getAlias('@web').'/img/logo/'. $model->idGuest->alias_team .'.png',['class'=>'img-responsive']);
            $score = Html::tag('p',$model->score_h.' : '.$model->score_g,['class' => 'bold h3', 'style' => 'padding-top: 20px;']);
            //$logo = Html::tag('div',$h_logo,['class' => 'col-xs-4 col-xs-push-1']).Html::tag('div',$score,['class' => 'col-xs-4']).Html::tag('div',$g_logo,['class' => 'col-xs-4 col-xs-pull-1']);
            $home = Html::img(Yii::getAlias('@web').'/img/logo/'. $model->idHome->alias_team .'.png',['class'=>'img-responsive']).Html::tag('p', $model->idHome->name_team/*.'<p class="h6 nowrap">('.$model->idHome->city.')</p>'*/, ['class' => 'h5 text-uppercase reset-margin bold nowrap']);
            $guest = Html::img(Yii::getAlias('@web').'/img/logo/'. $model->idGuest->alias_team .'.png',['class'=>'img-responsive']).Html::tag('p', $model->idGuest->name_team/*.'<p class="h6 nowrap">('.$model->idGuest->city.')</p>'*/, ['class' => 'h5 text-uppercase reset-margin bold nowrap']);
            $label = Html::tag('div',$home,['class' => 'col-xs-4']).Html::tag('div',$score,['class' => 'col-xs-4 reset-padding']).Html::tag('div',$guest,['class' => 'col-xs-4']);
            return $label;

        },
    ]); ?>

    <div class="panel-footer">
        <?= ListView::widget([
            'dataProvider' => Yii::$app->currentFootballData->getNextMatchProvider(),
            'summary'=>'',
            'itemView' => function($model) {
                $stadium = ( !is_null($model->id_stadium) ? Html::tag('p', 'Стадион «'.$model->idStadium->name.'»', ['class' => 'text-center']).Html::tag('p','г. '.$model->idStadium->city, ['class' => 'text-center']) : null);
                return $stadium;

            },
        ]); ?>
    </div>
</div>

