<?php
use yii\helpers\Html;
use yii\helpers\Url;

Yii::$app->view->registerJsFile('@web/js/tagcanvas.min.js',['position' => yii\web\View::POS_HEAD]);
$this->title = 'ФК Телеком';
$date = Yii::$app->currentFootballData->getNextMatchDate()['date'];
?>
<!--<section class="bg-image-default row hidden-xs" id="team">
    <h1 class="text-uppercase blue-text bg-75 img-label">один город - одна команда</h1>
</section>-->
<!--section matches & tournament-->
<!--<section class="row">
    <div class="subsection content-box col-xs-12 bg-white">
            <div class="col-xs-6 col-sm-2" style="padding: 15px;">
                <?= Html::img(Yii::getAlias('@web').'/img/vips/fotorazdaev.jpg', ['class'=>'img-responsive']); ?>
            </div>
            <div class="col-xs-6 col-sm-10 text-center" style="padding: 15px;">
                <?= Html::tag('h2', 'Поздравляем с 70-летним юбилеем', ['class' => 'text-uppercase blue-text underline']) ?>
                <?= Html::tag('p', 'Председателю Правления, '.Html::a( 'Виталию Александровичу Раздаеву', 'https://ru.wikipedia.org/wiki/%D0%A0%D0%B0%D0%B7%D0%B4%D0%B0%D0%B5%D0%B2,_%D0%92%D0%B8%D1%82%D0%B0%D0%BB%D0%B8%D0%B9_%D0%90%D0%BB%D0%B5%D0%BA%D1%81%D0%B0%D0%BD%D0%B4%D1%80%D0%BE%D0%B2%D0%B8%D1%87', ['class' => 'h4 text-uppercase bold blue-text']).' 70 лет!', ['class' => 'h4 text-uppercase bold balck-text']) ?>
                <?= Html::tag('p', 'Желаем Вам светлого счастья в жизни и неугасаемого оптимизма, отменной удачи и бравого здоровья.', ['class' => 'h4 text-uppercase bold balck-text']) ?>
            </div>
        </div>
         
    
</section>-->
<section class="row" id="matches">
    <!--tournament short table-->
    <?php
    if (isset($tournament)) {
        echo $this->render('_tours', ['tours' => $tournament, 'league' => $league, 'params' => $params]);
        echo $this->render('_matches', ['matches' => $matches, 'tournament' => $tournament, 'league' => $league, 'params' => $params]);
    } else {
        echo $this->render('_matches', ['matches' => $matches, 'league' => $league, 'params' => $params, 'headers' => $headers]);
    }
    ?>
</section>
<!--section about DTV Telecom-->
<section class="row bg-image-default hidden-xs clearfix" id="ad-telecom">
    <div class="subsection col-sm-5">
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
    <div class="subsection col-sm-4 bg-75 middle-vertical">
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

