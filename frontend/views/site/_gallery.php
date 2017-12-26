<?php

use yii\helpers\Html;
use common\modules\media\helpers\FileHelper;
?>
<div class="row gallery" id="gallery">
    <?php foreach ($pictures as $picture):
        echo Html::tag('div', Html::img($picture,['class'=>'img-responsive']),['class' => 'col-xs-4 col-sm-4 col-md-3 item-gallery wrap-img']);
     endforeach; ?>
</div>
