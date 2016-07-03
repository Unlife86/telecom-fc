<?php
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\widgets\ListView;
$this->title = 'Статистика';
?>
<header class="header-section bg-75">
    <div class="row bg-grey" style="margin-bottom: 15px;">
        <div class="col-xs-2">
            <?= Html::img(Yii::getAlias('@web').'/img/logo/'. $team->alias_team .'.png',['class'=>'img-responsive']);?>
        </div>
        <div class="col-xs-10">
            <h2 class="text-uppercase blue-text "><?= $team->name_team?></h2>
            <p class="h4 reset-margin">г. <?= $team->city?>, Кемеровская область</p>
        </div>
    </div>
    <ul class="breadcrumb">
        <li><a href='/site/index'>Главная</a></li>
        <li>Статистика ФК <?= $team->name_team?></li>
    </ul>
</header>
<div class="subsection bg-white">
    <h2 class="text-uppercase blue-text underline">Статистика ФК <?= $team->name_team?></h2>
    <?= $this->render('_static_team', ['matches' => $matchProvider]) ?>
    </ul>
<!--</div>
<div class="subsection bg-white">-->
    <h2 class="text-uppercase blue-text underline">Другие команды</h2>
    <?= ListView::widget([
        'dataProvider' => $teamProvider,
        'summary'=>'',
        'options' => ['class'=>'carousel-team', 'id' => 'carousel-team', 'data-show' => '4', 'style' => 'margin-top: 30px;'],
        'itemOptions' => ['class'=>'col-xs-3 content-box text-center bg-grey'],
        'itemView' => function($model) {
            $url = Url::to(['pages/static', 'id_team'=>$model['id_team']]);
            $number = Html::tag('div',Html::img(Yii::getAlias('@web').'/img/logo/'. $model->alias_team .'.png',['class'=>'img-responsive']),['class'=> 'center-block col-xs-5 white-text logo-team']);
            $name = Html::tag('p',$model->name_team);
            $textLadel = Html::tag('div',$name,['class'=> 'col-xs-12 reset-padding text-uppercase']);
            return $number.Html::a($textLadel, $url);
        },
    ]);?>
</div>