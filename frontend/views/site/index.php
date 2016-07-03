<?php
use yii\helpers\Html;
use yii\helpers\Url;

Yii::$app->view->registerJsFile('@web/js/tagcanvas.min.js',['position' => yii\web\View::POS_HEAD]);
$this->title = 'ФК Телеком';
$date = Yii::$app->currentFootballData->getNextMatchDate()['date'];
?>
<!--<section class="bg-image-full row  hidden-xs" id="team">
    <h1 class="text-uppercase blue-text bg-75 img-label">один город - одна команда</h1>
</section>-->
<!--section matches & tournament-->
<section class="row" id="matches">
    <!--Next match-->
    <div class="subsection content-box col-xs-12 col-sm-12 col-md-4 bg-white">
        <?php
        if ($date == null) {
            echo $this->render('_lastMatch');
        } else {
            echo $this->render('_nextMatch');
        }
        ?>
    </div>
    <!--tournament short table-->
            <?php
                if ($league->type == 'play-off') {
                    echo $this->render('_play-off', ['tours' => $tours, 'tour' => $tour, 'league' => $league]);
                } else {
                    echo $this->render('_tours', ['tours' => $tours, 'league' => $league]);
                }
            ?>
        </div>
        <!--Look full table-->
        <footer class="footer-sub text-center">
            <?= Html::a('Посмотреть турнир', Url::to(['/pages/tournament', 'idLeague' => $league->id, 'tour' => $tour, 'season' => $season]), ['class'=>'btn btn-primary btn-lg text-uppercase']);?>
        </footer>
    </div>
    <!--Result matches-->
    <?php if ($league->type != 'play-off') { ?>
    <div class="subsection content-box col-xs-12 col-sm-6 col-md-4 bg-white">
        <div class="content">
            <h2 class="text-uppercase blue-text underline">матчи в турнире</h2>
            <?= $this->render('_matches', ['matches' => $matches]) ?>
        </div>
        <!--Look all result-->
        <footer class="footer-sub text-center">
            <?= Html::a('Все матчи', Url::to(['/pages/results', 'idLeague' => $league->id, 'tour' => $tour, 'season' => $season]), ['class'=>'btn btn-primary btn-lg text-uppercase']);?>
        </footer>
    </div>
    <?php } ?>
</section>
<!--section about DTV Telecom-->
<section class="row bg-image-full hidden-xs" id="ad-telecom">
    <div class="subsection content-box col-sm-5">
        <div class="content">
            <div id="myCanvasContainer">
                <canvas height="317" id="myCanvas">
                    <p>In Internet Explorer versions up to 8, things inside the canvas are inaccessible!</p>
                </canvas>
            </div>
            <div id="tags">
                <ul>
                    <li><a href="#"><img src="img/channels/1.png" alt="game channel"></a></li>
                    <li><a href="#"><img src="img/channels/2.png" alt="our football channel"></a></li>
                    <li><a href="#"><img src="img/channels/3.png" alt="match channel"></a></li>
                    <li><a href="#"><img src="img/channels/4.png" alt="our sport channel"></a></li>
                    <li><a href="#"><img src="img/channels/5.png" alt="arena channel"></a></li>
                    <li><a href="#"><img src="img/channels/6.png" alt="football one channel"></a></li>
                    <li><a href="#"><img src="img/channels/7.png" alt="football two channel"></a></li>
                    <li><a href="#"><img src="img/channels/8.png" alt="football three channel"></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="subsection content-box col-sm-4 col-sm-push-3 bg-75 middle-vertical">
        <div class="content">
            <h2 class="text-uppercase blue-text text-center"><p>подключайся</p><p>и</p><p>смотри</p></h2>
            <p class="h4 text-center">матчи любимых команд</p>
            <p class="h4 text-center">в цифровом качестве</p>
            <a class="btn btn-primary btn-lg text-uppercase" href="http://lenkuz.ru/" role="button">хочу смотреть</a>
        </div>
    </div>
</section>
<!--section about team of club-->
<!--<section class="row bg-white" id="players-staff">
    <div class="subsection content-box col-xs-12">
        <div class="content overflow-hidden">
            <h2 class="text-uppercase blue-text underline">основной состав</h2>
            <?= $this->render('_team',['team'=>$team]) ?>
        </div>
    </div>
</section>-->
<!--section events & pictures-->
<section class="row" id="events-gallery">
    <!--events club-->
    <div class="subsection content-box col-md-6 bg-white">
        <div class="content overflow-hidden">
            <h2 class="text-uppercase blue-text underline">События</h2>
            <?= $this->render('_events',['events'=>$events]) ?>
        </div>
        <!--More events-->
        <footer class="footer-sub text-right" id="byB">
            <?= Html::a('Все события', Url::to(['/team/events',]), ['class'=>'btn btn-primary btn-lg text-uppercase']);?>
        </footer>
    </div>
    <!--pictures gallery-->
    <div class="subsection content-box col-md-6 bg-white">
        <div class="content">
            <h2 class="text-uppercase blue-text underline">Галлерея</h2>
            <?= $this->render('_gallery') ?>
        </div>
        <footer class="footer-sub text-right">
            <?= Html::a('Все фотографии', Url::to(['/pages/gallery',]), ['class'=>'btn btn-primary btn-lg text-uppercase']);?>
        </footer>
    </div>
</section>

