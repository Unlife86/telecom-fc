<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Matches */

$this->title = 'Новый Матч';
$this->params['breadcrumbs'][] = ['label' => 'Матчи', 'url' => ['index', 'MatchesSearch[id_league]' => 1, 'MatchesSearch[id_season]' => 3]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="customer-form">

    <?= $this->render('_form', [
            'model' => $model,
    ]) ?>

</div>
