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

<div class="matches-form row">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-xs-6"><?= $form->field($model, 'date_match')->widget(
            DateTimePicker::className(),[
            'name' => 'datetime_10',
            'options' => ['placeholder' => 'Дата матча ...'],
            //'convertFormat' => true,
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'yyyy-mm-dd hh:ii',
                //'startDate' => '01-Mar-2014 12:00 AM',
                //'todayHighlight' => true
            ]
        ])->label(false);
        ?>
    </div>
    <div class="col-xs-6"><?= $form->field($model, 'id_stadium')->dropDownList(
            ArrayHelper::map(Stadiums::find()->all(),'id','name'),
            ['prompt'=>'Стадион ...']
        )->label(false) ?>
    </div>
    <div class="col-xs-4"><?= $form->field($model, 'id_league')->dropDownList(
            ArrayHelper::map(League::find()->all(),'id','name'),
            ['prompt'=>'Турнир ...']
        )->label(false) ?>
    </div>
    <div class="col-xs-4"><?= $form->field($model, 'id_season')->dropDownList(
            ArrayHelper::map(Seasons::find()->all(),'id','year'),
            ['prompt'=>'Сезон ...']
        )->label(false) ?>
    </div>
    <div class="col-xs-4">
        <?= $form->field($model, 'n_tour')->textInput(['placeholder' => 'Номер тура ...'])->label(false) ?>
    </div>
    <div class="col-xs-4"><?= $form->field($model, 'id_home')->dropDownList(
            ArrayHelper::map(FootballTeam::find()->all(),'id_team','name_team','city'),
            ['prompt'=>'Хозяева ...']
        )->label(false) ?>
    </div>
    <div class="col-xs-2">
        <?= $form->field($model, 'score_h')->textInput(['placeholder' => 'Счет ...'])->label(false) ?>
    </div>
    <div class="col-xs-4"><?= $form->field($model, 'id_guest')->dropDownList(
            ArrayHelper::map(FootballTeam::find()->all(),'id_team','name_team', 'city'),
            ['prompt'=>'Гости ...']
        )->label(false) ?>
    </div>
    <div class="col-xs-2">
        <?= $form->field($model, 'score_g')->textInput(['placeholder' => 'Счет ...'])->label(false) ?>
    </div>

    <div class="form-group col-xs-2">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
