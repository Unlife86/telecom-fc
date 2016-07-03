<?php
use yii\widgets\Pjax;
$this->title = 'Результаты матчей';
$names = [
    'tournament' => 'Турнирная таблица',
    'group' => 'Групповой турнир',
    'play-off' => 'Плей-офф',
];
?>
<header class="header-section bg-75">
    <h1 class="text-uppercase blue-text "><?= $current['name_league']?>: Календарь игр</h1>
    <ul class="breadcrumb">
        <li><a href='/site/index'>Главная</a></li>
        <li><?= $current['name_league']?></li>
        <li>Календарь игр</li>
    </ul>
</header>
<div class="subsection bg-white">
    <div class="row">
        <div class="">
            <?= $this->render('_submenu', ['current' => $current, 'names' => $names]) ?>
        </div>
        <div class="col-xs-10">
            <?= $this->render('_matches', ['dataProvider' => $providers['played'], 'caption' => '']);?>
            <!--<footer class="footer-sub text-center">
                <a class="btn btn-primary btn-lg text-uppercase" data-click="9" href="#" role="button">еще игры</a>

            </footer>-->
        </div>
        <div class="col-xs-2" style="padding-top: 55px;">
            <?= $this->render('_season', ['current' => $current, 'dropList' => $dropList, 'action' => 'results']) ?>
        </div>
    </div>
</div>