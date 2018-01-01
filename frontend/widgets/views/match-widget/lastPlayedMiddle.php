<?php

use yii\helpers\Html;
use yii\widgets\ListView;
?>
<div class="content">
    <h2 class="text-uppercase blue-text underline">Последний результат</h2>
    <?= ListView::widget([
        'dataProvider' => Yii::$app->currentFootballData->getNextMatchProvider(),
        'summary'=>'',
        'itemOptions' => ['class'=>'row match text-center', 'style' => 'display: table-cell; vertical-align: middle; height: 304px;'],
        'itemView' => function($model) {
            //$h_logo = Html::img(Yii::getAlias('@web').'/img/logo/'. $model->idHome->alias_team .'.png',['class'=>'img-responsive']); $g_logo = Html::img(Yii::getAlias('@web').'/img/logo/'. $model->idGuest->alias_team .'.png',['class'=>'img-responsive']);
            $score = Html::tag('p',$model->score_h.' : '.$model->score_g,['class' => 'bold h3', 'style' => 'padding-top: 25px;']);
            //$logo = Html::tag('div',$h_logo,['class' => 'col-xs-4 col-xs-push-1']).Html::tag('div',$score,['class' => 'col-xs-4']).Html::tag('div',$g_logo,['class' => 'col-xs-4 col-xs-pull-1']);
            $home = Html::img(Yii::getAlias('@web').'/img/logo/'. $model->idHome->alias_team .'.png',['class'=>'img-responsive']).Html::tag('p', $model->idHome->name_team.'<p class="h6 nowrap">('.$model->idHome->city.')</p>', ['class' => 'h4 text-uppercase reset-margin bold nowrap']);
            $guest = Html::img(Yii::getAlias('@web').'/img/logo/'. $model->idGuest->alias_team .'.png',['class'=>'img-responsive']).Html::tag('p', $model->idGuest->name_team.'<p class="h6 nowrap">('.$model->idGuest->city.')</p>', ['class' => 'h4 text-uppercase reset-margin bold nowrap']);
            $label = Html::tag('div',$home,['class' => 'col-xs-5']).Html::tag('div',$score,['class' => 'col-xs-2 reset-padding']).Html::tag('div',$guest,['class' => 'col-xs-5']);
            return $label;

        },
    ]); ?>
</div>
<?= ListView::widget([
    'dataProvider' => Yii::$app->currentFootballData->getNextMatchProvider(),
    'summary'=>'',
    'itemOptions' => ['class'=>'footer-sub', 'tag' => 'footer' ],
    'itemView' => function($model) {
        $stadium = Html::tag('p', 'Стадион «'.$model->idStadium->name.'»', ['class' => 'h4 text-center']);
        $address = Html::tag('p', $model->idStadium->city.', '.$model->idStadium->address, ['class' => 'text-center']);;
        return $stadium.$address;

    },
]); ?>
