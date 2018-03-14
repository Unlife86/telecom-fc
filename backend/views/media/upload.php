<?php

use kartik\file\FileInput;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'Загрузка файлов';
$this->params['breadcrumbs'][] = $this->title;

echo FileInput::widget([
    'model' => $model,
    'attribute' => 'mediaFiles',
    'options' => ['multiple' => true],
    'pluginOptions' => ['previewFileType' => 'any', 'uploadUrl' => Url::to(['/media/upload'])]
]);

/*echo FileInput::widget([
    'model' => $model,
    'attribute' => 'mediaFiles',
    'options' => ['multiple' => true]
]);**/

?>