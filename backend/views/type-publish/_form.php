<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model backend\models\TypePublish */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
 
$this->registerJs(
   '$("document").ready(function(){ 
        $("#new-type").on("pjax:end", function() {
            $.pjax.reload({container:"#type-publish"});
        });
    });'
);
?>

<div class="type-publish-form">

    <?php Pjax::begin(['id' => 'new-type']) ?>
    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true ]]); ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('type')])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Сохранить' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php Pjax::end() ?>

</div>
