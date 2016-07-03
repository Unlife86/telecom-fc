<?php

use yii\helpers\Html;



/* @var $this yii\web\View */
/* @var $model backend\models\Matches */

$this->title = 'Новый Матч';
$this->params['breadcrumbs'][] = ['label' => 'Matches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="matches-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
