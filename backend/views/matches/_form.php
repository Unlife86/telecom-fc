<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\datetime\DateTimePicker;
use common\models\Seasons;
use common\models\FootballTeam;
use common\models\League;
use common\models\Stadiums;

/* @var $this yii\web\View */
/* @var $model backend\models\Matches */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-xs-4">
            <?= $form->field($model, 'id_league')->dropDownList(
                ArrayHelper::map(League::find()->all(),'id','name'),
                ['prompt'=>'Турнир ...']
            )->label(false) ?>
            <?= $form->field($model, 'id_season')->dropDownList(
                ArrayHelper::map(Seasons::find()->all(),'id','year'),
                ['prompt'=>'Сезон ...']
            )->label(false) ?>
            <?= $form->field($model, 'n_tour')->textInput(['placeholder' => 'Номер тура ...'])->label(false) ?>
        </div>
        <div class="col-xs-4">
            <?= $form->field($model, 'date_match')->widget(
                DateTimePicker::className(),[
                'name' => 'datetime_10',
                'options' => ['placeholder' => 'Дата матча ...'],
                'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'yyyy-mm-dd hh:ii',
                ]
            ])->label(false); ?>
            <?= $form->field($model, 'id_stadium')->dropDownList(
                ArrayHelper::map(Stadiums::find()->all(),'id','name', 'city'),
                ['prompt'=>'Стадион ...']
            )->label(false); ?>
            <?= $form->field($model, 'postponed')->widget(\kartik\checkbox\CheckboxX::classname(), ['pluginOptions'=>['threeState'=>false]]); ?>
        </div>
        <div class="col-xs-4">
            <?= $form->field($model, 'id_home')->dropDownList(
                ArrayHelper::map(FootballTeam::find()->all(),'id_team','name_team','city'),
                ['prompt'=>'Хозяева ...']
            )->label(false) ?>
            <?= $form->field($model, 'id_guest')->dropDownList(
                ArrayHelper::map(FootballTeam::find()->all(),'id_team','name_team', 'city'),
                ['prompt'=>'Гости ...']
            )->label(false) ?>
        </div>
        <div class="col-xs-1">
            
        </div>
        <!--<div class="col-xs-4">
            <?= $form->field($model, 'postponed')->checkbox(['label' => 'Матч перенесен', 'style' => 'margin-right:15px;']); ?>
        </div>-->
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>
