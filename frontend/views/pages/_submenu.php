<?php

use yii\widgets\Menu;
?>
<div class="bg-grey">
        <?php
            if ($current['id_league'] == 4) {
                $itemsUl = [
                    ['label' => 'Календарь игр', 'url' => ['/pages/results', 'idLeague' => $current['id_league'], 'tour' => $current['n_tour'], 'season' => $current['id_season']]],
                    ['label' => $names['group'], 'url' => ['/pages/tournament', 'idLeague' => 3, 'tour' => Yii::$app->currentFootballData->getCurrentTour($current['id_season'], 3), 'season' => $current['id_season']]],
                    ['label' => $names['play-off'], 'url' => ['/pages/tournament', 'idLeague' => 4, 'tour' => $current['n_tour'], 'season' => $current['id_season']]]
                ];
            } else if (($current['id_league'] == 3) and (Yii::$app->currentFootballData->getCurrentLeague($current['id_league'])->current == 0)) {
                $itemsUl = [
                    ['label' => 'Календарь игр', 'url' => ['/pages/results', 'idLeague' => 4, 'tour' => Yii::$app->currentFootballData->getCurrentTour($current['id_season'], 4), 'season' => $current['id_season']]],
                    ['label' => $names['group'], 'url' => ['/pages/tournament', 'idLeague' => 3, 'tour' => Yii::$app->currentFootballData->getCurrentTour($current['id_season'], 3), 'season' => $current['id_season']]],
                    ['label' => $names['play-off'], 'url' => ['/pages/tournament', 'idLeague' => 4, 'tour' => Yii::$app->currentFootballData->getCurrentTour($current['id_season'], 4), 'season' => $current['id_season']]]
                ];
            } else {
                $itemsUl = [
                    ['label' => 'Календарь игр', 'url' => ['/pages/results', 'idLeague' => $current['id_league'], 'tour' => $current['n_tour'], 'season' => $current['id_season']]],
                    ['label' => $names[$current['type_league']], 'url' => ['/pages/tournament', 'idLeague' => $current['id_league'], 'tour' => $current['n_tour'], 'season' => $current['id_season']]],
                ];
            }
            echo Menu::widget([
                'items' => $itemsUl,
                'itemOptions' => ['class' => 'text-uppercase'],
                'activeCssClass'=>'active',
                'options' => [
                    'class' => 'nav nav-tabs',
                ]
            ]);
        ?>
</div>

