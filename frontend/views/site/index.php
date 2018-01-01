<?php
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\widgets\MatchWidget;

Yii::$app->view->registerJsFile('@web/js/tagcanvas.min.js',['position' => yii\web\View::POS_HEAD]);
$this->title = 'ФК Телеком';
?>
<section class="row">
<?= MatchWidget::widget([
    'type' => 'nextWillPlay',
    'filterParams' => [
        'league_id' => [2,4],
        'season_id' => 3,
    ],
    'styleTag' => [
        'team-logo' => [
            'width' => '75%',
            'background-position' => 'center center',
            'background-repeat' => 'no-repeat',
            'background-size' => 'contain',
        ],
        'nowrap-text' => [
            'text-overflow' => 'ellipsis',
            'white-space' => 'nowrap',
            'overflow' => 'hidden',
        ],
        'footer-sub.bg-white' => [
            'background-color' => '#ffffff',
        ],
    ],
]) ?>
</section>
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
            <div class="row gallery" id="gallery">
                <?php foreach ($pictures as $picture):
                    echo Html::tag('div', Html::img($picture, ['class'=>'img-responsive']),['class' => 'col-xs-4 col-sm-4 col-md-3 item-gallery wrap-img']);
                endforeach; ?>
            </div>
        </div>
        <footer class="footer-sub text-right">
            <?= Html::a('Все фотографии', Url::to(['/pages/gallery',]), ['class'=>'btn btn-primary btn-lg text-uppercase']);?>
        </footer>
    </div>
</section>

