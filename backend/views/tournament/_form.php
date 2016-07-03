<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Seasons;
use common\models\FootballTeam;
use common\models\RegionGroup;
use common\models\League;

/* @var $this yii\web\View */
/* @var $model backend\models\Tournament */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tournament-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'positon_in_tour')->textInput() ?>
    <?= $form->field($model, 'id_team')->dropDownList(
        ArrayHelper::map(FootballTeam::find()->all(),'id_team','name_team'),
        ['prompt'=>'Select home team']
    ) ?>
    <?= $form->field($model, 'plays')->textInput() ?>
    <?= $form->field($model, 'c_wins')->textInput() ?>
    <?= $form->field($model, 'c_dead_heat')->textInput() ?>
    <?= $form->field($model, 'c_loses')->textInput() ?>
    <?= $form->field($model, 'scored_goals')->textInput() ?>
    <?= $form->field($model, 'conceded_goals')->textInput() ?>
    <?= $form->field($model, 'current_point')->textInput() ?>
    <?= $form->field($model, 'id_league')->dropDownList(
        ArrayHelper::map(League::find()->all(),'id','name'),
        ['prompt'=>'Select league']
    ) ?>
    <?= $form->field($model, 'id_group')->dropDownList(
        ArrayHelper::map(RegionGroup::find()->all(),'id','name_group'),
        ['prompt'=>'Select league']
    ) ?>
    <?= $form->field($model, 'id_season')->dropDownList(
        ArrayHelper::map(Seasons::find()->all(),'id','year'),
        ['prompt'=>'Select season year']
    ) ?>

    <?= $form->field($model, 'n_tour')->textInput() ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
