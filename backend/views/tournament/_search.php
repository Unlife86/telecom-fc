<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TournamentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tournament-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'n_tour') ?>

    <?= $form->field($model, 'id_season') ?>

    <?= $form->field($model, 'id_team') ?>

    <?= $form->field($model, 'scored_goals') ?>

    <?= $form->field($model, 'conceded_goals') ?>

    <?= $form->field($model, 'plays') ?>

    <?php // echo $form->field($model, 'c_dead_heat') ?>

    <?php // echo $form->field($model, 'c_loses') ?>

    <?php // echo $form->field($model, 'current_point') ?>

    <?php // echo $form->field($model, 'positon_in_tour') ?>

    <?php // echo $form->field($model, 'id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
