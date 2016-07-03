<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PlayersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="players-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'type_id') ?>

    <?= $form->field($model, 'first_name_player') ?>

    <?= $form->field($model, 'middle_name_player') ?>

    <?= $form->field($model, 'last_name_player') ?>

    <?php // echo $form->field($model, 'age') ?>

    <?php // echo $form->field($model, 'n_player') ?>

    <?php // echo $form->field($model, 'date_birth') ?>

    <?php // echo $form->field($model, 'height') ?>

    <?php // echo $form->field($model, 'facebook') ?>

    <?php // echo $form->field($model, 'twiter') ?>

    <?php // echo $form->field($model, 'vk') ?>

    <?php // echo $form->field($model, 'ok') ?>

    <?php // echo $form->field($model, 'google') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
