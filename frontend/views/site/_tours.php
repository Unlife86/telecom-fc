<?php

use yii\grid\GridView;
$models = $tours->getModels();
$caption = $models[0]->idGroup->name_group;
?>
    <div class="subsection content-box col-xs-12 col-sm-6 col-md-4 bg-white">
        <div class="content">
            <h2 class="text-uppercase blue-text underline"><?= $league->name?></h2>
<?= GridView::widget([
    'options' => ['class'=>'reset-margin', 'style' => 'overflow: auto; height: 310px;'],
    'summary'=>'',
    'caption' => '<h3 class="text-uppercase bold reset-margin">'.$caption.'</h3>',
    'captionOptions' => ['class' => 'reset-padding'],
    'dataProvider' => $tours,
    'tableOptions' => ['class' => 'table table-bordered short',/* 'id' => 'table-list-match',*/ 'style'=>'margin-top: 30px;'],
    'headerRowOptions' => ['class' => 'bg-grey',],
    //'showHeader' => false,
    'columns' => [
        [
            'label' => '#',
            'value'=>'positon_in_tour',
        ],
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