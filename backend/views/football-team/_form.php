<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\RegionGroup;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\FootballTeam */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="football-team-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_team')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'alias_team')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'id_group')->dropDownList(
        ArrayHelper::map(RegionGroup::find()->all(),'id','name_group'),
        ['prompt'=>'Set region']
    ) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
