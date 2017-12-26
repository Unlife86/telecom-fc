<?php

use yii\helpers\Html;
use yii\widgets\ListView;
$model = Yii::$app->currentFootballData->getNextMatchProvider()->getModels()[0];
?>
<style>
    .team-logo {
        width: 75%;height: 120px;
        background-position: center center;
        background-repeat: no-repeat;
        background-size: contain;
    }
    .nowrap-text {
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
    }
    .footer-sub.bg-white {
        background-color: #ffffff;
    }
</style>
<header class="header-section text-center">
    <?= Html::tag('h2', 'следующий матч', ['class' => 'text-uppercase blue-text underline']) ?>
    <?= Html::tag('p', $model->idLeague->name.' / '.$model->n_tour.' тур', ['class' => 'h4 bold text-uppercase blue-text'])?>
</header>
<div class="content bg-grey" style="height: auto;">
    <div class="row reset-margin">
        <div class="col-xs-12 col-md-5">
            <div class="col-lg-4">
                <div class="team-logo pull-right" style="background-image: url(<?= Yii::getAlias('@web').'../img/logo/'. $model->idHome->alias_team .'.png'?>);"></div>
            </div>
            <div class="col-xs-12 col-md-8 text-right" style="margin-top: 15px">
                <?= Html::tag('p', $model->idHome->name_team, ['class' => 'h3 bold text-uppercase nowrap-text'])?>
                <?= Html::tag('p', '('.$model->idHome->city.')', ['class' => 'h4 text-uppercase nowrap-text', 'style' => 'margin-top: 15px']) ?>
            </div>
        </div>
        <div class="col-xs-12 col-md-2"></div>
        <div class="col-xs-12 col-md-5">
            <div class="col-lg-4 pull-right">
                <div class="team-logo" style="background-image: url(<?= Yii::getAlias('@web').'../img/logo/'. $model->idGuest->alias_team .'.png'?>)"></div>
            </div>
            <div class="col-xs-12 col-md-8"  style="margin-top: 15px">
                <?= Html::tag('p', $model->idGuest->name_team, ['class' => 'h3 bold text-uppercase nowrap-text'])?>
                <?= Html::tag('p', '('.$model->idGuest->city.')', ['class' => 'h4 text-uppercase nowrap-text', 'style' => 'margin-top: 15px']) ?>
            </div>
        </div>
    </div>


    <?php /*ListView::widget([
        'dataProvider' => Yii::$app->currentFootballData->getNextMatchProvider(),
        'summary'=>'',
        'itemOptions' => ['class'=>'row match text-center'],
        'itemView' => function($model) {
            $home = Html::img(Yii::getAlias('@web').'/img/logo/'. $model->idHome->alias_team .'.png',['class'=>'img-responsive']).Html::tag('p', $model->idHome->name_team.'<p class="h6">('.$model->idHome->city.')</p>', ['class' => 'h4 text-uppercase reset-margin bold nowrap']);
            $guest = Html::img(Yii::getAlias('@web').'/img/logo/'. $model->idGuest->alias_team .'.png',['class'=>'img-responsive']).Html::tag('p', $model->idGuest->name_team.'<p class="h6">('.$model->idGuest->city.')</p>', ['class' => 'h4 text-uppercase reset-margin bold nowrap']);;
            return Html::tag('div',$home,['class' => 'col-xs-5']).Html::tag('div',$guest,['class' => 'col-xs-offset-2 col-xs-5']);

        },
    ]); */?>
</div>
<footer class="footer-sub bg-white">
    <?php
    if (Yii::$app->formatter->asDate($model->date_match, 'php:H') == '00') {
        $stadium = Html::tag('p', Yii::$app->formatter->asDate($model->date_match, 'php:d F'),['class' => 'h4 text-center bold']);
    } else {
        $stadium = Html::tag('p', Yii::$app->formatter->asDate($model->date_match, 'php:j F, Y | H:i'), ['class' => 'h4 text-center bold']);
    }
    if ($model->id_stadium != 0) {
        $address = Html::tag('p', 'Стадион «'.$model->idStadium->name.'», г. '.$model->idStadium->city, ['class' => 'h5 text-center']);
        echo $stadium.$address;
    }
    ?>
</footer>
<?php /*ListView::widget([
    'dataProvider' => Yii::$app->currentFootballData->getNextMatchProvider(),
    'summary'=>'',
    'itemOptions' => ['class'=>'footer-sub', 'tag' => 'footer', 'style' => 'min-height: 86px' ],
    'itemView' => function($model) {
        if (Yii::$app->formatter->asDate($model->date_match, 'php:H') == '00') {
            $stadium = Html::tag('p', Yii::$app->formatter->asDate($model->date_match, 'php:d F'),['class' => 'h4 text-center']);
        } else {
            $stadium = Html::tag('p', Yii::$app->formatter->asDate($model->date_match, 'php:d F в H:i'), ['class' => 'h4 text-center']);
        }
        if ($model->id_stadium != 0) {
            $address = Html::tag('p', 'Стадион «'.$model->idStadium->name.'», г. '.$model->idStadium->city, ['class' => 'text-center']);
            return $stadium.$address;
        }
        return $stadium;

    },
]); */?>
