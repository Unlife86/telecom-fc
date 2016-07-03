<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Matches */
$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Matches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$season = \common\models\Seasons::findOne($model->id_season)->year;
$home = \common\models\FootballTeam::findOne($model->id_home)->name_team;
$guest = \common\models\FootballTeam::findOne($model->id_guest)->name_team;
?>
<div class="matches-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            ['attribute'=>'date_match','format'=>['date']],
            [
                'label'=>'Season',
                'value'=> $season, //$season[0]['year'],
            ],
            'n_tour',
            ['attribute'=>'id_home', 'value' => $home,],
            ['attribute'=>'id_guest', 'value' => $guest,],
            'score_h',
            'score_g',
        ],
    ]) ?>

</div>
