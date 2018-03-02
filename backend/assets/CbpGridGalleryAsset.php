<?php

namespace backend\assets;

use yii\web\AssetBundle;

class CbpGridGalleryAsset extends AssetBundle
{
    public $basePath = '@webroot/cbpGridGallery';
    public $baseUrl = '@web/cbpGridGallery';
    public $css = [
        'css/component.css',
    ];
    public $js = [
        ['js/modernizr.custom.js', ['position' => \yii\web\View::POS_HEAD]],
        'js/imagesloaded.pkgd.min.js',
        'js/masonry.pkgd.min.js',
        'js/classie.js',
        'js/cbpGridGallery.js',
    ];
}
