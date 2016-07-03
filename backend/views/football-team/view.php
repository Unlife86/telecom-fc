<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\FootballTeam */

$this->title = $model->id_team;
$this->params['breadcrumbs'][] = ['label' => 'Football Teams', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="football-team-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_team], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_team], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_team',
            'name_team',
            'alias_team',
        ],
    ]) ?>

</div>
