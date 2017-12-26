<?php

use yii\helpers\Html;
use yii\widgets\Menu;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
$name_t = [
    '2' => [/*'1/8 финала', */'1/4 финала', 'Полуфинал', 'Полуфинал: Ответные матчи', 'Финал'],
    '4' => ['Полуфинал', '3 место', 'Финал'],
];

?>
<?php $form = ActiveForm::begin(['action' => [$action],'method' => 'get',]); ?>
    <?= Html::dropDownList('season', $current['id_season'],ArrayHelper::map($dropList['seasons'], 'id_season', 'idSeason.year'),['class' => 'form-control', 'onchange'=>'this.form.submit()']);?>
<?php ActiveForm::end(); ?>
<?php
$itemsUl = [];
foreach ($dropList['tours'] as $tour):
    if(array_key_exists($tour->id_league, $name_t)) {
        $itemLi = ['label' => $name_t[$tour->id_league][$tour->n_tour - 1], 'url' => ['/pages/'.$action, 'idLeague' => $tour->id_league, 'tour' => $tour->n_tour, 'season' => $current['id_season']]];
    } else {
        $itemLi = ['label' => $tour->n_tour.' тур', 'url' => ['/pages/'.$action, 'idLeague' => $tour->id_league, 'tour' => $tour->n_tour, 'season' => $current['id_season']]];
    }
    array_push($itemsUl, $itemLi);
endforeach;
echo Menu::widget([
    'items' => $itemsUl,
    'itemOptions' => ['class' => 'list-group-item'],
    'activeCssClass'=>'active',
    'options' => [
        'class' => 'list-group months text-uppercase',
    ]
]);
?>