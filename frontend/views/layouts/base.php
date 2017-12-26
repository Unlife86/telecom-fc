<?php

$date = Yii::$app->currentFootballData->getNextMatchDate()['date'];

use yii\helpers\Html;
use frontend\components\widgets\HeaderSite;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\assets\HeadAsset;
use common\widgets\Alert;
use yii\helpers\Url;

AppAsset::register($this);
HeadAsset::register($this);

$this->beginPage() ?>

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
    <?php $this->beginBody(); 
        if (Url::current() == '/index.php?r=site%2Findex') {
            echo '<div class="container bg-50">';
        } else {
            echo '<div class="container bg-50" style="min-width: 1024px">';
        } ?>

        <?= HeaderSite::widget([]) ?>

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
        
        <section class="row bg-grey general">
            <div class="subsection content-box col-xs-12">
                    <div class="carousel-sponsors" data-slick='{"slidesToShow": 2}' style="padding: 60px 0 30px">
                        <?= Html::a(null,'http://shahter-lk.ru/',[
                                'class' => 'bg-image-default', 
                                'style' => 'background-image: url(/img/sponsors/miner_stadium.png)'
                            ]) ?>
                        <?= Html::a(null,'http://www.ssmp42.ru/',[
                                'class' => 'bg-image-default', 
                                'style' => 'background-image: url(/img/sponsors/first-aid.png)'
                            ]) ?>
                    </div>
            </div>               
        </section>
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
