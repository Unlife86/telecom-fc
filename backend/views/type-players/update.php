<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TypePlayers */

$this->title = 'Update Type Players: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Type Players', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="type-players-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
