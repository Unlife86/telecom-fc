<?php
$this->beginContent('@app/views/layouts/base.php'); $date = Yii::$app->currentFootballData->getNextMatchDate()['date']; ?>
<div class="row">
    <section class="col-xs-9">
        <?= $content ?>
    </section>
    <aside class="col-xs-3">
        <div class="ad-carousel">
            <div class="panel panel-default" style="position: relative;height: 394.4px; background-image: url(<?=Yii::getAlias('@web')?>/img/banners/present.jpg);background-size: contain;background-repeat: no-repeat;">
                <div class="panel-body" style="position: absolute; bottom: 0;left: 0;right: 0;text-align: center;">
                    <a class="btn btn-primary btn-lg text-uppercase" href="http://lenkuz.ru/internet/tarifs/" role="button">подключиться</a>
                </div>
            </div>
            <div class="panel panel-default" style="position: relative;height: 394.4px; background-image: url(<?=Yii::getAlias('@web')?>/img/banners/sports.jpg);background-size: contain;background-repeat: no-repeat;">
                <div class="panel-body" style="position: absolute; bottom: 0;left: 0;right: 0;text-align: center;">
                    <a class="btn btn-primary btn-lg text-uppercase" href="http://lenkuz.ru/internet/tarifs/" role="button">подключиться</a>
                </div>
            </div>
        </div>
        <?php
        if ($date == null) {
            echo $this->render('_lastMatch');
        } else {
            echo $this->render('_nextMatch');
        }
        ?>
    </aside>
</div>
<?php $this->endContent(); ?>
