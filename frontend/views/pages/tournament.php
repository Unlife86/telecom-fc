<?php

use yii\widgets\Pjax;
use yii\helpers\Html;

$names = [
    'tournament' => 'Турнирная таблица',
    'group' => 'Групповой турнир',
    'play-off' => 'Плей-офф',
];

$this->title = $current['name_league'];
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = ['label' => $names[$current['type_league']]];
$this->params['header-section']['h1'] = $this->title.': '.$names[$current['type_league']];
if ($current['type_league'] != 'play-off') {
    $this->params['header-section']['tour_season'] = [$current['n_tour'], Yii::$app->currentFootballData->getYearSeason($current['id_season'])];
}

?>
<div class="subsection bg-white">
    <div class="row">
        <div class="">
            <?= $this->render('_submenu', ['current' => $current, 'names' => $names]) ?>
        </div>
        <?php
            if ($current['type_league'] == 'play-off') {
                echo Html::tag('div', $this->render('_play-off', ['tournament' => $tournament, 'current' => $current]), ['class' => 'col-xs-12', 'style' => 'padding: 0;']);
            } else {
                if ($current['type_league'] == 'group') {
                    echo '<div class="col-xs-10">';
                    foreach ($tournament as $group):
                        echo $this->render('_tours', ['tournament' => $group]).$this->render('_matches', ['dataProvider' => $matchProvider, 'caption' => 'матчи сыгранные в туре']);
                    endforeach;
                    echo '</div>';
                } else if ($current['type_league'] == 'tournament') {
                   echo Html::tag('div', $this->render('_tours', ['tournament' => $tournament]).$this->render('_matches', ['dataProvider' => $matchProvider, 'caption' => 'матчи сыгранные в туре']), ['class' => 'col-xs-10']);
                }
                echo Html::tag('div', $this->render('_season', ['current' => $current, 'dropList' => $dropList, 'action' => 'tournament']), ['class' => 'col-xs-2', 'style' => 'padding-top: 61px;']);
            }
        ?>
    </div>
</div>