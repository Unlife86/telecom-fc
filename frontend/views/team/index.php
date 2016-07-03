<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
$this->title = 'Основной состав'
?>
<header class="header-section bg-75">
    <h1 class="text-uppercase blue-text ">Основной состав</h1>
    <ul class="breadcrumb">
        <li><a href='/site/index'>Главная</a></li>
        <li>Основной состав</li>
    </ul>
</header>
<div class="subsection bg-white">
    <div class="row">
        <div class="col-xs-12">
            <?= GridView::widget([
                'options' => ['class'=>'reset-margin'],
                'summary'=>'',
                'dataProvider' => $team,
                'tableOptions' => ['class' => 'table list-item', 'style'=>'table-layout: fixed; margin-top: 0;'],
                'showHeader' => false,
                'rowOptions' => ['class' => 'bg-grey'],
                'columns' => [
                    [
                        'format'=>'html',
                        'value'=>function ($model) {
                            return Html::tag('div',Html::img(Yii::getAlias('@web').'/img/team/'. $model->n_player .'.jpg',['class'=>'img-responsive']),['class'=> 'wrap-img']);
                        },
                        'contentOptions' => ['class'=>'col-xs-2 bg-blue content-box'],
                    ],
                    [
                        'value'=>function ($model) {
                            return Html::tag('p',$model->n_player,['class'=> 'h2']);
                        },
                        'contentOptions' => ['class'=>'col-xs-2'],
                        'format'=>'html',
                    ],
                    [
                        'value'=>function ($model) {
                            return Html::tag('p',$model->last_name_player,['class'=> 'text-uppercase bold']).$model->first_name_player;
                        },
                        'contentOptions' => ['class'=>'col-xs-3'],
                        'format'=>'html',
                    ],

                    [
                        'value'=>function ($model) {
                            return Html::tag('p',$model->type->type_name,['class'=> 'text-uppercase bold']);
                        },
                        'contentOptions' => ['class'=>'col-xs-3 text-uppercase bold'],
                        'format'=>'html',
                    ],
                    [
                        'value'=>function ($model) {
                            $url = Url::to(['team/index', 'id_player'=>$model['id']]);
                            return Html::a('профиль', $url, ['class'=>'btn btn-primary btn-more']);
                        },
                        'contentOptions' => ['class'=>'col-xs-2 text-uppercase'],
                        'format'=>'html',
                    ],

                ],
            ]); ?>
        </div>
    </div>
</div>