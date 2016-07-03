<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MatchesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="matches-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'date_match') ?>

    <?= $form->field($model, 'id_season') ?>

    <?= $form->field($model, 'n_tour') ?>

    <?= $form->field($model, 'id_home') ?>

    <?= $form->field($model, 'id_stadium') ?>

    <?php // echo $form->field($model, 'score_h') ?>

    <?php // echo $form->field($model, 'score_g') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
