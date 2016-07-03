<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\DetailView;
use yii\helpers\Url;
$this->title = 'Игроки: '.$player->first_name_player .' '.$player->last_name_player;
?>
<header class="header-section bg-75">
    <h1 class="text-uppercase blue-text "><?= $player->first_name_player .' '.$player->last_name_player?></h1>
    <ul class="breadcrumb">
        <li><a href='/site/index'>Главная</a></li>
        <li><a href='/team/players'>Команда</a></li>
        <li><?= $player->first_name_player .' '.$player->last_name_player?></li>
    </ul>
</header>
<div class="subsection bg-white">
    <div class="table-profile">
        <div class="row">
            <div class="col-xs-4 col-xs-offset-1 bg-blue content-box" style= "height: 316px;">
                <?= Html::img(Yii::getAlias('@web').'/img/team/'. $player->n_player .'.jpg',['class'=>'img-responsive full-width']);?>
            </div>
            <div class="col-xs-6">
                <header class="row text-uppercase text-center">
                    <div class="col-xs-9">
                        <p class="h3 header-section"><strong><?= $player->first_name_player .' '.$player->last_name_player?></strong></p>
                    </div>
                    <div class="col-xs-3">
                        <p class="h3 bg-blue white-text header-section"><?= $player->n_player?></p>
                    </div>
                </header>
                <?= DetailView::widget([
                    'model' => $player,
                    'options' => [
                        'class' => 'table table-striped detail-view',
                        'style' => 'margin-bottom: auto; margin-top: 20px;'
                    ],
                    'attributes' => [
                        [
                            'label' => 'Позиция',
                            'value' => $player->type->type_name,
                        ],
                        [
                            'label' => 'Возраст',
                            'value' => $player->age,
                        ],
                        [
                            'label' => 'Дата рождения',
                            'value' => Yii::$app->formatter->asDate($player->date_birth, 'php:j F Y'),
                        ],
                        [
                            'label' => 'Рост',
                            'value' => $player->height.' м',
                        ],
                        [
                            'label' => 'Контакты',
                            'value' => ' ',
                        ],
                    ],
                ]) ?>
            </div>
        </div>
    </div>
<!--</div>
<div class="subsection bg-white">-->
    <h2 class="text-uppercase blue-text underline">Другие члены команды</h2>
    <?= ListView::widget([
        'dataProvider' => $team,
        'summary'=>'',
        'options' => ['class'=>'carousel-team', 'id' => 'carousel-team', 'data-show' => '3', 'style' => 'margin-top: 30px;'],
        'itemOptions' => ['class'=>'bg-blue col-xs-3 content-box text-center'],
        'itemView' => function($model) {
            $url = Url::to(['team/index', 'id_player'=>$model['id']]);
            $number = Html::tag('div',Html::tag('p',$model->n_player,['class'=> 'h2']),['class'=> 'col-xs-3 white-text reset-padding']);
            $name = Html::tag('p',$model->first_name_player.' '.$model->last_name_player, ['class'=> 'h5']);
            $position = Html::tag('p',$model->type->type_name, ['class'=> 'h6']);
            $textLadel = Html::tag('div',$name.$position,['class'=> 'col-xs-9 reset-padding bg-grey text-uppercase']);
            return Html::a($number.$textLadel, $url);
        },
    ]);?>
</div>