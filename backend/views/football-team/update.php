<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\FootballTeam */

$this->title = 'Update Football Team: ' . ' ' . $model->id_team;
$this->params['breadcrumbs'][] = ['label' => 'Football Teams', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_team, 'url' => ['view', 'id' => $model->id_team]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="football-team-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
