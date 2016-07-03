<?php
use yii\helpers\FileHelper;
use yii\helpers\Html;
$dir = Yii::getAlias('@webroot');
$pictures = FileHelper::findFiles($dir.'/img/gallery/');
?>
<div class="row gallery" id="gallery">
    <?php foreach ($pictures as $picture): ?>
        <div class="col-xs-4 col-sm-4 col-md-3 item-gallery wrap-img">
           <?= Html::img(Yii::$app->currentFootballData->getFilesFolder('/img/gallery/', $picture),['class'=>'img-responsive']);?>
        </div>
    <?php endforeach; ?>
</div>
