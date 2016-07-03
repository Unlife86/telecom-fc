<?php

use yii\widgets\Menu;
?>
<div class="bg-grey">
        <?php
            if ($current['id_league'] == 4) {
                $itemsUl = [
                    ['label' => 'Календарь игр', 'url' => ['/pages/results', 'idLeague' => $current['id_league'], 'tour' => $current['tour'], 'season' => $current['season']]],
                    ['label' => $names['group'], 'url' => ['/pages/tournament', 'idLeague' => 3, 'tour' => Yii::$app->currentFootballData->getCurrentTour($current['season'], 3), 'season' => $current['season']]],
                    ['label' => $names['play-off'], 'url' => ['/pages/tournament', 'idLeague' => 4, 'tour' => $current['tour'], 'season' => $current['season']]]
                ];
            } else if (($current['id_league'] == 3) and (Yii::$app->currentFootballData->getCurrentLeague($current['id_league'])->current == 0)) {
                $itemsUl = [
                    ['label' => 'Календарь игр', 'url' => ['/pages/results', 'idLeague' => 4, 'tour' => Yii::$app->currentFootballData->getCurrentTour($current['season'], 4), 'season' => $current['season']]],
                    ['label' => $names['group'], 'url' => ['/pages/tournament', 'idLeague' => 3, 'tour' => Yii::$app->currentFootballData->getCurrentTour($current['season'], 3), 'season' => $current['season']]],
                    ['label' => $names['play-off'], 'url' => ['/pages/tournament', 'idLeague' => 4, 'tour' => Yii::$app->currentFootballData->getCurrentTour($current['season'], 4), 'season' => $current['season']]]
                ];
            } else {
                $itemsUl = [
                    ['label' => 'Календарь игр', 'url' => ['/pages/results', 'idLeague' => $current['id_league'], 'tour' => $current['tour'], 'season' => $current['season']]],
                    ['label' => $names[$current['type_league']], 'url' => ['/pages/tournament', 'idLeague' => $current['id_league'], 'tour' => $current['tour'], 'season' => $current['season']]],
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

