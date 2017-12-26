<?php

namespace common\components;

use Yii;

interface FileStorageInterface
{
    public static function findFiles($dir, $options = []);

    public static function uploadFiles();
}

?>