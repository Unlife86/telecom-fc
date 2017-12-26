<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TypePublishSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Статусы публикаций';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-publish-index">

    <?= $this->render('_form', [
        'model' => $searchModel,
    ]) ?>

    <?php Pjax::begin(['id' => 'type-publish']) ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                
                'id',
                'type',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    <?php Pjax::end() ?>

</div>
