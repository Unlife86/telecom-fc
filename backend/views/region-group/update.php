<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RegionGroup */

$this->title = 'Update Region Group: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Region Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="region-group-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
