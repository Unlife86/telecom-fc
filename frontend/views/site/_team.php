<?php
use yii\widgets\ListView;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<?= ListView::widget([
    'dataProvider' => $team,
    'summary'=>'',
    'options' => ['class'=>'carousel-team', 'id' => 'carousel-team', 'data-show' => '4'],
    'itemOptions' => ['class'=>'col-xs-6 col-lg-3 bg-blue item-team content-box'],
    'itemView' => function($model) {
        $url = Url::to(['team/player', 'id_player'=>$model['id']]);
        $img = Html::img(Yii::getAlias('@web').'/img/team/'. $model->n_player .'.jpg',['class'=>'img-responsive']);
        $textLadel = Html::tag('p', $model->first_name_player.' '.$model->last_name_player,['class'=> 'h4 text-uppercase bg-white bold']).Html::tag('p', $model->type->type_name,['class'=> 'h5 text-uppercase bg-white bold']);
        return Html::a($img.Html::tag('div',$textLadel,['class'=> 'img-label text-right black-text']), $url);
    },
]);?>