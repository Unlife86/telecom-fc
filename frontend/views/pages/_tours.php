<?php

use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

$caption = $tournament->totalCount > 0 ? $tournament->getModels()[0]->idGroup->name_group : '';

?>
<?= GridView::widget([
            'options' => ['class'=>'reset-margin'],
            'summary'=>'',
            'dataProvider' => $tournament,
            'tableOptions' => ['class' => 'table table-bordered table-hover', /*'style'=>'margin-top: 30px;'*/],
            'caption' => '<h3 class="text-uppercase">'.$caption.'</h3>',
            'headerRowOptions' => ['class' => 'bg-grey',],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'label' => 'Команда',
                    'format'=>'html',
                    'value'=> function($model) {
                        return '<strong>'.$model->idTeam->name_team.'</strong><p class="h6 reset-margin">('.$model->idTeam->city.')</p>';
                    },
                    'contentOptions' => ['class'=>'col-xs-3'],
                ],
                [
                    'label' => 'Игры',
                    'value'=>'plays',
                ],
                [
                    'label' => 'Победы',
                    'value'=>'c_wins',
                ],
                [
                    'label' => 'Ничьи',
                    'value'=>'c_dead_heat',
                ],
                [
                    'label' => 'Поражения',
                    'value'=>'c_loses',
                ],
                [
                    'label' => 'Мячи',
                    'value'=>function($model) {
                        $goals = $model->scored_goals - $model->conceded_goals;
                        if ($goals > 0) { $goals = '+'.$goals; }
                        return $model->scored_goals .' - '. $model->conceded_goals.' = '.$goals;
                    }
                ],
                [
                    'label' => 'Очки',
                    'value'=>'current_point',
                ],
                /*[
                    'label' => 'Очки',
                    'value'=>function($model) {
                        $total = ($model->plays) * 3;
                        $missing = $total - $model->current_point;
                        return $model->current_point.' - '.$missing;
                    }
                ],*/
            ],
            'rowOptions' => function ($model) {
                $url = Url::to(['pages/static', 'id_team'=>$model['id_team']]);
                return ['onclick' => 'window.open("'.$url.'","_self");'];
            },
        ]); ?>
