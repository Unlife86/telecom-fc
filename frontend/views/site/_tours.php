<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$model = $tours->getModels()[0];
?>
<div class="subsection content-box col-xs-12 col-md-4 bg-white">
    <header class="header-section">
        <?= Html::tag('h2', 'турнирная таблица', ['class' => 'text-uppercase blue-text underline']) ?>
        <?= Html::tag('p', $league->name, ['class' => 'h4 bold text-uppercase blue-text'])?>
    </header>
    <div class="content" style="height: auto;">
        <?= GridView::widget([
            'options' => ['class'=>'reset-margin'/*, 'style' => 'overflow: auto; height: 310px;'*/],
            'summary'=>'',
            'caption' => '<h3 class="text-uppercase bold">'.$model->idGroup->name_group.' / '.$model->n_tour.' тур </h3>',
            //'captionOptions' => ['class' => 'reset-padding'],
            'dataProvider' => $tours,
            'tableOptions' => ['class' => 'table table-bordered short',/* 'id' => 'table-list-match', 'style'=>'margin-top: 30px;'*/],
            'headerRowOptions' => ['class' => 'bg-grey',],
            //'showHeader' => false,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'label' => 'Команда',
                    'value'=> function($model) {
                        return '<strong>'.$model->idTeam->name_team.'</strong><p class="h6 reset-margin">('.$model->idTeam->city.')</p>';
                    },
                    'format'=>'html',
                ],
                [
                    'label' => 'Игры',
                    'value'=>'plays',
                ],
                [
                    'label' => 'Очки',
                    'value'=>function($model) {
                        //$total = ($model->plays) * 3;
                        //$missing = $total - $model->current_point;
                        return $model->current_point/*.' - '.$missing*/;
                    }
                ],
            ],
        ]); ?>
    </div>
    <footer class="footer-sub text-center">
        <?= Html::a('вся Таблица', Url::to(['/pages/tournament', 'idLeague' => $league->id, 'tour' => $params['n_tour'], 'season' => $params['id_season']]), ['class'=>'btn btn-primary btn-lg text-uppercase']);?>
    </footer>
</div>

