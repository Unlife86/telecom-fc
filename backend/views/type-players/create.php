<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TypePlayers */

$this->title = 'Create Type Players';
$this->params['breadcrumbs'][] = ['label' => 'Type Players', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-players-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
