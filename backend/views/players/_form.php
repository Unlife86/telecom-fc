<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\TypePlayers;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Players */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="players-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type_id')->dropDownList(
        ArrayHelper::map(TypePlayers::find()->all(),'id','type_name'),
        ['prompt'=>'Select type of player']
    ) ?>

    <?= $form->field($model, 'first_name_player')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'middle_name_player')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name_player')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'age')->textInput() ?>

    <?= $form->field($model, 'n_player')->textInput() ?>

    <?= $form->field($model, 'date_birth')->textInput() ?>

    <?= $form->field($model, 'height')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'facebook')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'twiter')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ok')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'google')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
