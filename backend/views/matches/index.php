<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MatchesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Матчи';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="matches-index">
    <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::button('Добавить матч', ['value' => Url::to('index.php?r=matches/create'), 'class' => 'btn btn-success', 'id' => 'modalButton']) ?>
    </p>
    <?php
        Modal::begin([
            'header' => '<h4>Новый матч</h4>',
            'id' => 'modal',
            'size' => 'modal-lg',
        ]);
        echo '<div id="modalContent"></div>';
        Modal::end();
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'date_match',
                'value'=>function($model) {
                    if (!empty($model->date_match)) {
                        Yii::$app->formatter->locale = 'ru-RU';
                        return Yii::$app->formatter->asDate($model->date_match, 'd MMMM');
                    }

                }
            ],
            [
                'attribute'=>'id_stadium',
                'value'=>'idStadium.name',
            ],
            [
                'attribute'=>'id_season',
                'value'=>'idSeason.year',
            ],
            [
                'attribute' => 'id_league',
                'value' => 'idLeague.name'
            ],
            //'id',
            'n_tour',
            [
                'attribute'=>'id_home',
                'value'=> function($model) {
                    if ($model->id_home != 0) {
                        return $model->idHome->name_team .' ( '. $model->idHome->city.')';
                    } else {
                        return '';
                    }
                },
            ],
            [
                'label'=>'Счет',
                'value' => function($model) {
                    if (strlen($model->score_h) == 0) {
                        return '-:-';
                    } else {
                        return $model->score_h .' : '. $model->score_g;
                    }

                }
            ],
            //'score_h','score_g',
            //'score_h',
            [
                'attribute'=>'id_guest',
                'value'=> function($model) {
                    if ($model->id_guest != 0) {
                        return $model->idGuest->name_team .' ( '. $model->idGuest->city.')';
                    } else {
                        return '';
                    }
                },
            ],
            //'score_g',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
