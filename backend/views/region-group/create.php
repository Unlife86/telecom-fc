<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\RegionGroup */

$this->title = 'Create Region Group';
$this->params['breadcrumbs'][] = ['label' => 'Region Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="region-group-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
