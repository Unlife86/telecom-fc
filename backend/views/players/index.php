<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PlayersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Players';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="players-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Players', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            'n_player',
            //'id',
            'first_name_player',
            //'middle_name_player',
            'last_name_player',
            [
                'attribute'=>'type_id',
                'value'=>'type.type_name',
            ],
            // 'age',

            // 'date_birth',
            // 'height',
            // 'facebook',
            // 'twiter',
            // 'vk',
            // 'ok',
            // 'google',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
