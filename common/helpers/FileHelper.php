<?php

namespace common\helpers;

use Yii;
use common\components\FileStorageInterface;

class FileHelper extends \yii\helpers\FileHelper implements FileStorageInterface
{
    public static function findFiles($dir, $options = [])
    {
        return array_map(
            function ($pathFile){
                return substr(FileHelper::normalizePath($pathFile ,"/"), strlen(Yii::getAlias('@assets')));
            },
            parent::findFiles(Yii::getAlias('@assets').$dir, $options)
            );
    }

    public static function uploadFiles()
    {

    }
}

?>