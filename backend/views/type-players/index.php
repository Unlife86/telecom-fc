<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TypePlayersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Type Players';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-players-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Type Players', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'type_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
