<?php

namespace common\helpers;

use Yii;
use common\components\FileStorageInterface;
use yii\helpers\ArrayHelper;

class FileHelper extends \yii\helpers\FileHelper implements FileStorageInterface
{
    /*public static function findFiles($dir, $options = [])
    {
        if (strripos($dir, Yii::getAlias('@assets')) === false) {
            $dir = Yii::getAlias('@assets').$dir;
        }
        
        return array_map(
            function ($pathFile){
                if (strripos($pathFile, Yii::getAlias('@assets')) === false) {
                    return $pathFile;
                }
                return substr(static::normalizePath($pathFile ,"/"), strlen(Yii::getAlias('@assets')));
            },
            parent::findFiles($dir, $options)
            );
    }*/

    public static function findFiles($dir, $options = [])
    {
        if (strripos($dir, Yii::getAlias('@assets')) === false) {
            $dir = Yii::getAlias('@assets').$dir;
        }

        if (!is_dir($dir)) {
            throw new InvalidParamException("The dir argument must be a directory: $dir");
        }
        $dir = rtrim($dir, DIRECTORY_SEPARATOR);
        if (!isset($options['basePath'])) {
            // this should be done only once
            $options['basePath'] = realpath($dir);
            $options = static::normalizeOptions($options);
        }
        
        $list = [];
        $handle = opendir($dir);
        if ($handle === false) {
            throw new InvalidParamException("Unable to open directory: $dir");
        }
        while (($file = readdir($handle)) !== false) {
            if ($file === '.' || $file === '..') {
                continue;
            }
            $path = $dir . DIRECTORY_SEPARATOR . $file;
            if (static::filterPath($path, $options)) {
                if (is_file($path)) {
                    $list[] = substr(static::normalizePath($path ,"/"), strlen(Yii::getAlias('@assets')));
                } elseif (is_dir($path) && (!isset($options['recursive']) || $options['recursive'])) {
                    $list = array_merge($list, static::findFiles($path, $options));
                }
            }
        }
        closedir($handle);

        return $list;
    }

    public static function uploadFiles($dir, $files)
    {
        foreach ($files as $file) {
            $file->saveAs($dir . $file->baseName . $file->extension);
        }
        return true;
    }

    public static function deleteFiles($files)
    {

    }
}

?>