<?php
use yii\widgets\Pjax;

$names = [
    'tournament' => 'Турнирная таблица',
    'group' => 'Групповой турнир',
    'play-off' => 'Плей-офф',
];
$this->title = $names[$current['type_league']];

?>
<header class="header-section bg-75">
    <ul class="breadcrumb">
        <li><a href='/site/index'>Главная</a></li>
        <li><?= $current['name_league']?></li>
        <li><?= $names[$current['type_league']] ?></li>
    </ul>
    <h1 class="text-uppercase blue-text "><?= $current['name_league']?>: <?= $names[$current['type_league']]?></h1>
<?php
    if ($current['type_league'] != 'play-off') {
        echo '<h2 class="text-uppercase blue-text underline">'.$current['tour'].' тур / сезон '. Yii::$app->currentFootballData->getYearSeason($current['season']).'</h2>';
    }
?>
</header>
<div class="subsection bg-white">
    <div class="row">
        <div class="">
            <?= $this->render('_submenu', ['current' => $current, 'names' => $names]) ?>
        </div>
        <?php
            if ($current['type_league'] == 'play-off') {
        ?>
                <div class="col-xs-12">
                    <?= $this->render('_play-off', ['tournament' => $tournament, 'current' => $current]); ?>
                </div>
        <?php
            } else {
        ?>
            <div class="col-xs-10">
            <?php
                if ($current['type_league'] == 'group') {
                    foreach ($tournament as $group):
                        echo $this->render('_tours', ['tournament' => $group]);
                    endforeach;
                } else if ($current['type_league'] == 'tournament') {
                    echo $this->render('_tours', ['tournament' => $tournament]);
                }
            ?>
            <?= $this->render('_matches', ['dataProvider' => $matchProvider, 'caption' => 'матчи сыгранные в туре']) ?>
            </div>
            <div class="col-xs-2" style="padding-top: 61px;">
                <?= $this->render('_season', ['current' => $current, 'dropList' => $dropList, 'action' => 'tournament']) ?>
            </div>
        <?php
            }
        ?>
    </div>
</div>