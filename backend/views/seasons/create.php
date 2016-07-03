<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Seasons */

$this->title = 'Create Seasons';
$this->params['breadcrumbs'][] = ['label' => 'Seasons', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seasons-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
