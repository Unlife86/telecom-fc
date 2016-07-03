<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RegionGroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Region Groups';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="region-group-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Region Group', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name_group',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
