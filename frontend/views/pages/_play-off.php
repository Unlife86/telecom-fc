<?php

use yii\grid\GridView;
use yii\helpers\Html;

if ($current['id_league'] == 2) {
    $rounds = [/*'1/8 финала', */'1/4 финала', 'Полуфинал', 'Полуфинал: Ответные матчи', 'Финал'];
    $height = 784;
} else if ($current['id_league'] == 4) {
    $rounds = ['Полуфинал', 'за 3 место', 'Финал'];
    $height = 246;
}
?>
<table style="width: 100%; table-layout: fixed; <?= $current['id_league'] == 4 ? '' : 'border-spacing: 5px 0;' ?>" class="rounds">
    <thead>
        <?php /*.(12 / count($rounds)).'*/foreach ($rounds as $round):
            echo '<th class="text-center" style="'.($current['id_league'] == 4 ? '' : ''/*'width: 160px;'*/).'">'.$round.'</th>';
        endforeach; ?>
    </thead>
    <tbody>
        <tr>
            <?php foreach ($rounds as $key => $value):
                if (($rounds[$key] == 'Полуфинал') and ($key < count($rounds)))  {
                    if ($rounds[$key + 1] == 'за 3 место') {
                        echo '<td class="col-xs-'.(12 / count($rounds)).' third-place">';
                    } elseif ($rounds[$key + 1] == 'Полуфинал: Ответные матчи') {
                        echo '<td class="return-matches" style="/*width: 160px;*/ padding: 0;">';
                    } else {
                        echo $current['id_league'] == 4 ? '<td class="col-xs-'.(12 / count($rounds)).'">' : '<td style="/*width: 160px;*/ padding: 0;">';
                    }
                }
                else {
                    echo $current['id_league'] == 4 ? '<td class="col-xs-'.(12 / count($rounds)).'">' : '<td style="/*width: 160px;*/ padding: 0;">';
                }
            ?>
                <?php
                if(array_key_exists($key, $tournament)) {
                    echo GridView::widget([
                        'options' => ['class'=>'reset-margin', 'style' => $current['id_league'] == 4 ? '' : ''/*'width: 160px'*/],
                        'summary'=>'',
                        'dataProvider' => $tournament[$key],
                        'tableOptions' => ['class' => 'playoff', 'style' => $current['id_league'] == 4 ? 'height: '.$height.'px;' : 'height: '.$height.'px; /*width: 160px;*/'],
                        'rowOptions' => $current['id_league'] == 4 ? '' : ['style' => 'width: 160px;'],
                        'showHeader' => false,
                        'columns' => [
                            [
                                'format' => 'html',
                                'value'=> function($model) {
                                    $home = [
                                        'name' => is_null($model->id_home) ? null : $model->idHome->name_team,
                                        'city' => is_null($model->id_home) ? null : Html::tag('span',' ('.$model->idHome->city.')', ['class'=>'h6 reset-margin']),
                                    ]; 
                                    $guest = [
                                        'name' => is_null($model->id_guest) ? null : $model->idGuest->name_team,
                                        'city' => is_null($model->id_guest) ? null : Html::tag('span',' ('.$model->idGuest->city.')', ['class'=>'h6 reset-margin']),
                                    ];
                                    $teams = Html::tag('div',Html::tag('p', $home['name'].$home['city'],['class' => 'bold']).Html::tag('p', $guest['name'].$guest['city'],['class' => 'bold']),['class' => 'col-xs-9']);                                    
                                    if ($model->id == 111) { //workaround Extra time and penalty render
                                        return $teams.Html::tag('div', Html::tag('p', $model->score_h.' : '.$model->score_g,['style' => 'margin: 0; padding: 5px 0']).Html::tag('p', 'ДВ 2 : 2',['style' => 'font-size: 12px; margin: 0;']).Html::tag('p', 'пен. 6 : 5',['style' => 'font-size: 12px; margin: 0;']), ['class' => 'col-xs-3']);
                                    }
                                    $contentP = $model->score_h.' : '.$model->score_g;
                                    if (is_null($model->score_h)) {
                                        $contentP = is_null($model->date_match) ? '' : date(similar_text('0000-00-00 00:00', $model->date_match, $percent) ? 'd.m' : 'd.m H:i', strtotime($model->date_match));
                                    }
                                    return $teams.Html::tag('div', Html::tag('p', $contentP, ['class' => (is_null($model->score_h) ? 'date' : 'score')]), ['class' => 'col-xs-3']);
                                },
                                'contentOptions' => ['style' => 'max-width: 160px; padding: 0;'],
                            ],
                        ],
                    ]);
                }
                    ?>
                </td>
            <?php endforeach; ?>
        </tr>
    </tbody>
</table>
<div style="padding: 0 15px">
<?php
foreach ($tournament as $tour):
    $model = array_filter($tour->getModels(), function ($item) {if ($item['date_match'] != null) {  return $item; } });
    if (count($model) > 0) {
        echo $this->render('_matches', ['dataProvider' => $tour, 'caption' => $rounds[$tour->getModels()[0]->n_tour - 1]]);
   }
endforeach;
?>
</div>



