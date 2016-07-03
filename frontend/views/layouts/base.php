<?php

$date = Yii::$app->currentFootballData->getNextMatchDate()['date'];
$leagues = Yii::$app->currentFootballData->getListLeague();
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\assets\HeadAsset;
use common\widgets\Alert;
use yii\helpers\Url;

AppAsset::register($this);
HeadAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <?php
        if (Url::current() == '/index.php?r=site%2Findex') {
            echo '<div class="container bg-50">';
        } else {
            echo '<div class="container bg-50" style="min-width: 1024px">';
        }
    ?>

        <header class="row general">
            <div class="row header-content">
                <div id="logo" class="col-xs-2" style="background-position: center;"></div>
                <div class="col-xs-9 header-text">
                    <p class="bold">ОФИЦИАЛЬНЫЙ САЙТ</p>
                    <p>Футбольного клуба «Телеком»</p>
                </div>
            </div>
            <?php
            NavBar::begin([
                /*'brandLabel' => 'ФК Телеком',
                'brandUrl' => Yii::$app->homeUrl,
                'brandOptions' => ['class' => 'visible-xs',],*/
                'screenReaderToggleText' => 'Меню сайта',
                'innerContainerOptions' => ['class' => 'row bg-white',],
                'options' => [
                    'class' => 'col-xs-12 general reset-margin',
                ],
            ]);
            //$itemLeague =[];
            $menuItems = [
                ['label' => 'Главная', 'url' => ['/site/index'], 'linkOptions' => ['class' => 'text-uppercase black-text']],
                ['label' => 'Клуб', 'url' => ['#'], 'linkOptions' => ['class' => 'text-uppercase black-text'], 'items' => [
                    ['label' => 'Статистика', 'url' => ['/pages/static'], 'linkOptions' => ['class' => 'text-uppercase black-text']],
                    ['label' => 'События', 'url' => ['/team/events'], 'linkOptions' => ['class' => 'text-uppercase black-text']],
                    ['label' => 'Медиа', 'url' => ['/pages/gallery'], 'linkOptions' => ['class' => 'text-uppercase black-text']],
                    ['label' => 'Контакты', 'url' => ['/pages/contacts'], 'linkOptions' => ['class' => 'text-uppercase black-text']],
                ]],
            ];
            foreach($leagues as $league):
                $season =  Yii::$app->currentFootballData->getCurrentSeason($league->id);
                $tour = Yii::$app->currentFootballData->getCurrentTour($season, $league->id);
                if (($league->id == 4) or ($league->id == 3)) {
                    if ($league->current == 1) {
                        array_push($menuItems,[
                            'label' => $league->name,
                            'url' => ['/pages/tournament', 'idLeague' => $league->id, 'tour' => $tour, 'season' => $season],
                            'linkOptions' => ['class' => 'text-uppercase black-text'],
                            /*'options' => ['class' => 'dropdown'],
                            'submenuOptions' => ['class' => 'dropdown-menu', 'style' => 'display: none; position: absolute; left: 100%; top: 0px;'],
                            'linkOptions' => ['class' => 'text-uppercase black-text'],
                            'items' => [
                                ['label' => 'Матчи', 'url' => ['/pages/results', 'idLeague' => $league->id, 'tour' => $tour, 'season' => $season], 'linkOptions' => ['class' => 'text-uppercase black-text']],
                                ['label' => 'Турнирная таблица', 'url' => ['/pages/tournament', 'idLeague' => $league->id, 'tour' => $tour, 'season' => $season], 'linkOptions' => ['class' => 'text-uppercase black-text']],
                            ]*/
                        ]);
                    } else {
                        array_push($menuItems,[
                            'label' => $league->name,
                            'url' => ['/pages/tournament', 'idLeague' => 4, 'tour' => $tour, 'season' => $season],
                            'linkOptions' => ['class' => 'text-uppercase black-text'],
                        ]);
                        break;
                    }
                } else {
                    array_push($menuItems,[
                        'label' => $league->name,
                        'url' => ['/pages/tournament', 'idLeague' => $league->id, 'tour' => $tour, 'season' => $season],
                        'linkOptions' => ['class' => 'text-uppercase black-text'],
                    ]);
                }
            endforeach;
            array_push($menuItems,
                    /*['label' => 'События', 'url' => ['/team/events'], 'linkOptions' => ['class' => 'text-uppercase black-text']],
                    ['label' => 'Медиа', 'url' => ['/pages/gallery'], 'linkOptions' => ['class' => 'text-uppercase black-text']]*/
                ['label' => 'Футбольная лига Кузбасса', 'url' => 'http://ligafutbola42.ucoz.ru', 'linkOptions' => ['class' => 'text-uppercase black-text']]
            );
            /*$menuItems = [
                ['label' => 'Главная', 'url' => ['/site/index'], 'linkOptions' => ['class' => 'text-uppercase black-text']],
                ['label' => 'Клуб', 'url' => ['#'], 'linkOptions' => ['class' => 'text-uppercase black-text'], 'items' => [
                    ['label' => 'Руководство', 'url' => ['/team/vips'], 'linkOptions' => ['class' => 'text-uppercase black-text']],
                    ['label' => 'Команда', 'url' => ['/team/index'], 'linkOptions' => ['class' => 'text-uppercase black-text']],
                    ['label' => 'Награды', 'url' => ['/team/awards'], 'linkOptions' => ['class' => 'text-uppercase black-text']],
                ]],
                ['label' => 'Лига', 'url' => 'http://ligafutbola42.ucoz.ru', 'linkOptions' => ['class' => 'text-uppercase black-text']],
                ['label' => 'Турниры', 'url' => ['#'], 'linkOptions' => ['class' => 'text-uppercase black-text'], 'items' => $itemLeague],
                ['label' => 'События', 'url' => ['/team/events'], 'linkOptions' => ['class' => 'text-uppercase black-text']],
                ['label' => 'Медиа', 'url' => ['/pages/gallery'], 'linkOptions' => ['class' => 'text-uppercase black-text']],
                ['label' => 'Контакты', 'url' => ['/pages/contacts'], 'linkOptions' => ['class' => 'text-uppercase black-text']],
            ];*/
            /*if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            } else {
                $menuItems[] = '<li>'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'btn btn-link']
                    )
                    . Html::endForm()
                    . '</li>';
            }*/
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
                'dropDownCaret' => '',
                'activateParents'=> true,
            ]);
            NavBar::end();
            ?>
        </header>
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <div id="imgModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <!--<h4 class="modal-title">Modal Header</h4>-->
                    </div>
                    <div class="modal-body">
                        <!--<img src="" class="img-responsive">-->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    </div>
                </div>

            </div>
        </div>
        <?= $content ?>
        <footer class="general">
            <!--<section class="row bg-grey">
                <div class="subsection content-box col-xs-12">
                    <div class="content">
                        <h2 class="text-uppercase blue-text underline">Спонсоры</h2>
                        <div class="carousel-sponsors" id="sponsors-slider" data-show="4">
                            <div class="content-box">
                                <img src="img/sponsors/example.png" class="img-responsive full-width" alt="member team">
                            </div>
                            <div class="content-box">
                                <img src="img/sponsors/example.png" class="img-responsive full-width" alt="member team">
                            </div>
                            <div class="content-box">
                                <img src="img/sponsors/example.png" class="img-responsive full-width" alt="member team">
                            </div>
                            <div class="content-box">
                                <img src="img/sponsors/example.png" class="img-responsive full-width" alt="member team">
                            </div>
                            <div class="content-box">
                                <img src="img/sponsors/example.png" class="img-responsive full-width" alt="member team">
                            </div>
                        </div>
                        <div class="slider-control full-width">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                            <span class="glyphicon glyphicon-chevron-right"></span>
                        </div>
                    </div>
                    <footer class="footer-sub text-right">
                        <?= Html::a('стать спонсором', Url::to(['/pages/contacts',]), ['class'=>'btn btn-primary btn-lg text-uppercase']);?>
                    </footer>
                </div>
            </section>-->
            <section class="row bg-white content-box">
                <div class="col-xs-11">
                    <p class="h3 text-uppercase blue-text"><strong>футбольный клуб телеком</strong></p>
                </div>
                <div id="go-top" class="col-xs-1 bg-blue">
                    <p class="glyphicon glyphicon-upload white-text"></p>
                </div>
            </section>
        </footer>
    </div>
<?php
if ($date != null) {
    $script = <<< JS
$(document).ready(function() {
$(function () {
var newYear = new Date($date);
$('#clock').countdown({until: newYear});
});
});
JS;
    $this->registerJs($script);
}

 $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
