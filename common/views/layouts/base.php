<?php

use yii\helpers\Html;

if (\Yii::$app->id === 'app-frontend') {
    \frontend\assets\AppAsset::register($this);
} else {
    \backend\assets\AppAsset::register($this);
}

$this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="<?= $bodyClass ?>">
    <?php $this->beginBody(); 
        if (isset($wrapperParams)) { echo Html::beginTag('div', $wrapperParams); }
            echo $content;
        if (isset($wrapperParams)) { echo Html::endTag('div'); }
    $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
