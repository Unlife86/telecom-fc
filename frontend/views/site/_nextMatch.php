<?php

use yii\helpers\Html;
use yii\widgets\ListView;
?>
<div class="content">
    <h2 class="text-uppercase blue-text underline">следующий матч</h2>
    <div id="clock"></div>
    <?= ListView::widget([
        'dataProvider' => Yii::$app->currentFootballData->getNextMatchProvider(),
        'summary'=>'',
        'itemOptions' => ['class'=>'row match text-center'],
        'itemView' => function($model) {
            $home = Html::img(Yii::getAlias('@web').'/img/logo/'. $model->idHome->alias_team .'.png',['class'=>'img-responsive']).Html::tag('p', $model->idHome->name_team.'<p class="h6">('.$model->idHome->city.')</p>', ['class' => 'h4 text-uppercase reset-margin bold nowrap']);
            $guest = Html::img(Yii::getAlias('@web').'/img/logo/'. $model->idGuest->alias_team .'.png',['class'=>'img-responsive']).Html::tag('p', $model->idGuest->name_team.'<p class="h6">('.$model->idGuest->city.')</p>', ['class' => 'h4 text-uppercase reset-margin bold nowrap']);;
            return Html::tag('div',$home,['class' => 'col-xs-5']).Html::tag('div',$guest,['class' => 'col-xs-offset-2 col-xs-5']);

        },
    ]); ?>
</div>
<?= ListView::widget([
    'dataProvider' => Yii::$app->currentFootballData->getNextMatchProvider(),
    'summary'=>'',
    'itemOptions' => ['class'=>'footer-sub', 'tag' => 'footer', 'style' => 'min-height: 86px' ],
    'itemView' => function($model) {
        if (Yii::$app->formatter->asDate($model->date_match, 'php:H') == '00') {
            $stadium = Html::tag('p', Yii::$app->formatter->asDate($model->date_match, 'php:d F'),['class' => 'h4 text-center']);
        } else {
            $stadium = Html::tag('p', Yii::$app->formatter->asDate($model->date_match, 'php:d F в H:i')/*.' Стадион «'.$model->idStadium->name.'»'*/, ['class' => 'h4 text-center']);
        }
        if ($model->id_stadium != 0) {
            $address = Html::tag('p', 'Стадион «'.$model->idStadium->name.'», г. '.$model->idStadium->city, ['class' => 'text-center']);
            return $stadium.$address;
        }
        return $stadium;

    },
]); ?>
