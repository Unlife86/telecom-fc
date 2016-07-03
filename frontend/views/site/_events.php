<?php
use yii\widgets\ListView;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<?= ListView::widget([
    'dataProvider' => $events,
    'summary'=>'',
    'options' => ['class'=>'events-feed', 'id' => 'events-feed', 'data-show' => '3'],
    'itemOptions' => ['class'=>'col-xs-6 item-event'],
    'itemView' => function($model) {
        $url = Url::to(['team/events', 'id_event'=>$model['id']]);
        $img = Html::tag('div',Html::img(Yii::getAlias('@web').'/img/events/'. $model->id .'/main.jpg',['class'=>'img-responsive']),['class'=> 'wrap-img']);
        $date = Html::tag('p',Yii::$app->formatter->asDate($model->date_event, 'php:d/m/Y H:i'), ['class'=> 'h6 text-right']);
        $header = Html::a($model->header_event, $url);
        return $img.$header.$date;
    },
]);?>
<div class="slider-control full-width">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="glyphicon glyphicon-chevron-right"></span>
</div>

<!--<div class="events-feed" id="events-feed">
    <div class="col-xs-6 item-event">
        <div class="wrap-img">
            <img src="img/news10.jpg" class="img-responsive" alt="Event header">
        </div>
        <h4 class="text-uppercase">21/09/2015</h4>
        <p class="h4">Черчесов: игроки не рабы, и их решения о переходах в другие клубы надо уважать</p>
    </div>
</div>-->
