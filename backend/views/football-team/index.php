<?php

use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\FootballTeamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Список команд Футбольной Лиги';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="football-team-index">
    <p>
        <?= Html::a('Добавить команду', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        //'tableOptions' => ['class' => 'table table-condensed'],
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id_team',
            'name_team',
            'alias_team',
            'city',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
