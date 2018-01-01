<?php

use yii\helpers\Html;
use yii\widgets\ListView;
?>
<?= Html::style($style) ?>
<header class="header-section text-center">
    <?= Html::tag('h2', $header, ['class' => 'text-uppercase blue-text underline']) ?>
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
</div>
<footer class="footer-sub bg-white">
    <?php
    if ($model->id_stadium != 0) {
        $address = Html::tag('p', 'Стадион «'.$model->idStadium->name.'», г. '.$model->idStadium->city, ['class' => 'h5 text-center']);
        echo $model->date_match.$address;
    }
    ?>
</footer>
