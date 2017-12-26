<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\League */

$this->title = 'Новая Лига';
$this->params['breadcrumbs'][] = ['label' => 'Лиги', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="league-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
