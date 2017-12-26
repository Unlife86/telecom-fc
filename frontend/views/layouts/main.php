<?php

use yii\helpers\Html;

$this->beginContent('@common/views/layouts/base.php', [
    'bodyClass' => isset($bodyClass) ? $bodyClass : null,
    'wrapperParams' => isset($wrapperParams) ? $wrapperParams : ['class' => 'container bg-50'],
]);    
?>
    <?= $this->render('header.php') ?>

    <div id="imgModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
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

<?php $this->endContent(); ?>
