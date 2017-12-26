<?php
use yii\widgets\Pjax;

$names = [
    'tournament' => 'Турнирная таблица',
    'group' => 'Групповой турнир',
    'play-off' => 'Плей-офф',
];

$this->title = $current['name_league'];
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = ['label' => 'Календарь игр'];
$this->params['header-section']['h1'] = $this->title.': Календарь игр';
$this->params['header-section']['tour_season'] = [$current['n_tour'], Yii::$app->currentFootballData->getYearSeason($current['id_season'])];

?>

<div class="subsection bg-white">
    <div class="row">
        <div class="">
            <?= $this->render('_submenu', ['current' => $current, 'names' => $names]) ?>
        </div>
        <div class="col-xs-10">
            <?= $this->render('_matches', ['dataProvider' => $providers['played'], 'caption' => '']);?>
        </div>
        <div class="col-xs-2" style="padding-top: 55px;">
            <?= $this->render('_season', ['current' => $current, 'dropList' => $dropList, 'action' => 'results']) ?>
        </div>
    </div>
</div>