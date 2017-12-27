<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

Yii::$app->view->registerJsFile('https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js',['position' => yii\web\View::POS_HEAD]);

?>

<div class="news-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'header_event')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_event')->textInput() ?>

    <?= $form->field($model, 'publish_status_id')->textInput() ?>

    <?= $form->field($model, 'full_text')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
