<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\LeagueSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Лиги';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="league-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Новая Лига', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'export' => false,
        'pjax'  => true,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'name',
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'type',
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
