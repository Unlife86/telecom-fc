<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\Seasons;
use common\models\FootballTeam;
use common\models\RegionGroup;
use common\models\League;

/* @var $this yii\web\View */
/* @var $model backend\models\Tournament */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tournament-form">

    <?php
    $form = ActiveForm::begin();
    /*echo $form->field($model, 'id_team')->dropDownList(
        ArrayHelper::map($model::find()->joinWith('idTeam')->andFilterWhere(['id_league' => $model->id_league, 'n_tour' => $model->n_tour])->all(), 'id_team', 'idTeam.name_team', 'idTeam.city'),
        ['prompt'=>'Команда', 'id' => 'tournament_id']
    );*/
    echo $form->field($model, 'id_team')->dropDownList(
        ArrayHelper::map(FootballTeam::find()->all(), 'id_team', 'name_team', 'city'),
        ['prompt'=>'Команда', 'id' => 'tournament_id']
    );
    ?>
    <table class="table">
        <tbody>
            <td><?= $form->field($model, 'positon_in_tour')->textInput() ?></td>
            <td><?= $form->field($model, 'plays')->textInput() ?></td>
            <td><?= $form->field($model, 'c_wins')->textInput() ?></td>
            <td><?= $form->field($model, 'c_dead_heat')->textInput() ?></td>
            <td><?= $form->field($model, 'c_loses')->textInput() ?></td>
            <td><?= $form->field($model, 'scored_goals')->textInput() ?></td>
            <td><?= $form->field($model, 'conceded_goals')->textInput() ?></td>
            <td><?= $form->field($model, 'current_point')->textInput() ?></td>
        </tbody>
    </table>
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

