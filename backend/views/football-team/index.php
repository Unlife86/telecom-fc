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

    <h1><?= Html::encode($this->title) ?></h1>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить команду', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id_team',
            'name_team',
            'alias_team',
            'city',
            [
                'attribute'=>'id_group',
                'value'=>'idGroup.name_group',

            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
