<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

$this->title = $dataProvider->getModels()[0]->idLeague->name.$title;
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="index">
    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'export' => false,
        'pjax'  => true,
        'columns' => $columns,
        'toolbar' => [
            [
                'content' => $toolbarContent,
            ],
        ],
        'panel' => [
            'type' => GridView::TYPE_DEFAULT,
            'heading' => '',
        ],
    ]); 
    ?>
</div>
