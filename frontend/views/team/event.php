<?php
use yii\helpers\Html;
use yii\helpers\FileHelper;
use yii\widgets\ListView;
use yii\helpers\Url;

$this->title ='События';
$dir = Yii::getAlias('@webroot');
$pictures = FileHelper::findFiles($dir.'/img/events/'.$event->id.'/');
Yii::$app->formatter->locale = 'ru-RU';
?>
<header class="header-section bg-75">
    <h1 class="text-uppercase blue-text ">События</h1>
    <ul class="breadcrumb">
        <li><a href='/site/index'>Главная</a></li>
        <li><a href='/team/events'>События</a></li>
        <li><?= $event->header_event?></li>
    </ul>
</header>
<div class="subsection bg-white">
    <div class="row">
        <div class="col-xs-3">
            <ul class="list-group">
                <?php foreach ($pictures as $picture): ?>
                    <li class="list-group-item">
                        <?= Html::img(Yii::$app->currentFootballData->getFilesFolder('/img/events/'. $event->id .'/', $picture),['class'=>'img-responsive img-modal', 'data-toggle' => 'modal', 'data-target'=> '#imgModal']);?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="col-xs-9">
            <p class="margin-horizontal" style="font-size: 16px; color: #8e979f;"><?=Yii::$app->formatter->asDate($event->date_event, 'php:j F Y, l G:i ')?></p>
            <h3 class="text-uppercase margin-horizontal"><?= $event->header_event?></h3>
            <?php
                $textEvent = explode("\r\n", $event->full_text);
                foreach ($textEvent as $part): ?>
                    <p class="h4 margin-horizontal"><?= $part?></p>
            <?php endforeach;?>
        </div>
    </div>
<!--</div>
<div class="subsection bg-white">-->
    <h2 class="text-uppercase blue-text underline">Другие новости</h2>
    <?= ListView::widget([
        'dataProvider' => $events,
        'summary'=>'',
        'options' => ['class'=>'events-feed', 'id' => 'events-feed', 'data-show' => '4'],
        'itemOptions' => ['class'=>'item-event col-xs-3 bg-grey content-box'],
        'itemView' => function($model) {
            $url = Url::to(['team/event', 'id_event'=>$model['id']]);
            $date = Html::tag('p',Yii::$app->formatter->asDate($model->date_event, 'php:d/m/Y H:i'), ['class'=> 'h6 margin-horizontal']);
            $header = Html::a('<p class="h5 margin-horizontal" style="color: rgb(51, 51, 51); font-weight: 700;">'.$model->header_event.'</p>', $url);
            return $date.$header;
        },
    ]);?>
</div>