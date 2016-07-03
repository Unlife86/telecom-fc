<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\widgets\Menu;
?>
<div class="row middle-vertical bg-grey">
    <div class="col-xs-1">
        <p class="h4 reset-margin">Год</p>
    </div>
    <div class="col-xs-2">
        <?php $form = ActiveForm::begin(['action' => ['tournament'],'method' => 'get',]); ?>
            <?= Html::dropDownList('season', $current['season'],ArrayHelper::map($dropList['seasons'], 'id_season', 'idSeason.year'),['class' => 'form-control year', 'onchange'=>'this.form.submit()']);?>
        <?php ActiveForm::end(); ?>
    </div>
    <div class="col-xs-1">
        <p class="h4 reset-margin">Туры</p>
    </div>
    <div class="col-xs-7 text-left" style="top: 3px;">
        <?php
            $itemsUl = [];
            foreach ($dropList['tours'] as $tour):
                $itemLi = ['label' => $tour->n_tour.' тур', 'url' => ['/pages/tournament', 'idLeague' => $current['id_league'], 'tour' => $tour->n_tour, 'season' => $current['season']]];
                array_push($itemsUl, $itemLi);
            endforeach;
            echo Menu::widget([
                'items' => $itemsUl,
                'activeCssClass'=>'active',
                'options' => [
                    'class' => 'pagination radius-reset',
                ]
            ]);
        ?>
    </div>
</div>

