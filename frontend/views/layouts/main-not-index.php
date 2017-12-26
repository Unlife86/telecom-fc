<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\Breadcrumbs;
use frontend\widgets\MatchWidget;

$this->beginContent('@app/views/layouts/main.php', [
    'bodyClass' => null,
    'wrapperParams' => [
        'class' => 'container bg-50',
        'style' => 'min-width: 1024px'
    ]
]); ?>

<div class="row">
    <section class="col-xs-9">
        <?php Pjax::begin(); ?>
            <header class="header-section bg-75">
                <?= Breadcrumbs::widget([
                    'homeLink' => ['label' => 'Главная', 'url' => Yii::$app->homeUrl],
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?php if (isset($this->params['header-section'])) {
                    if (isset($this->params['header-section']['h1'])) {
                        echo Html::tag('h1', $this->params['header-section']['h1'], ['class' => 'text-uppercase blue-text']);
                    }
                    if (isset($this->params['header-section']['tour_season'])) {
                        echo Html::tag('div', Html::tag('h2', $this->params['header-section']['tour_season'][0].' тур / сезон '.$this->params['header-section']['tour_season'][1], ['class' => 'text-uppercase blue-text underline']));
                    }
                } ?>
            </header>

            <?= $content ?>

        <?php Pjax::end(); ?>
    </section>

    <aside class="col-xs-3">
        <div class="ad-carousel">
            <?php foreach (\Yii::$app->media->findLocalFiles('/img/banners/') as $baner):
                echo Html::beginTag('div', ['class' => 'panel panel-default', 'style' => "background-image: url($baner)"]);
                    echo Html::tag('div', Html::a('подключиться', 'http://lenkuz.ru/internet/tarifs/', $options = ['class' => 'btn btn-primary btn-lg text-uppercase', 'role' => 'button']), ['class' => 'panel-body']);
                echo Html::endTag('div');
            endforeach; ?>
        </div>
        <?= MatchWidget::widget([
            'clock' => true,
            'position' => 'aside',
        ]) ?>
    </aside>
</div>
<?php $this->endContent(); ?>
