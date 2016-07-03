<?php
use yii\helpers\FileHelper;
use yii\helpers\Html;
$dir = Yii::getAlias('@webroot');
$pictures = FileHelper::findFiles($dir.'/img/gallery/');
$this->title = 'Медиа';
?>
<header class="header-section bg-75">
    <h1 class="text-uppercase blue-text ">Медиа</h1>
    <ul class="breadcrumb">
        <li><a href="#">Главная</a></li>
        <li>Медиа</li>
    </ul>
</header>
<div class="subsection bg-white"><div class="row">
        <div class="col-lg-12">
            <div class="row gallery" id="gallery">
                <?php foreach ($pictures as $picture): ?>
                    <div class="col-xs-3 item-gallery wrap-img">
                        <?= Html::img(Yii::$app->currentFootballData->getFilesFolder('/img/gallery/', $picture),['class'=>'img-responsive img-modal', 'data-toggle' => 'modal', 'data-target'=> '#imgModal']);?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>