<?php

namespace common\components;

use Yii;
use yii\base\Component;
use yii\base\DynamicModel;
use yii\helpers\ArrayHelper;

/**
 * Configure Apache web-server for Windows XAMPP:
 * 1. Create a folder 'alias' and in it a file 'common.conf' containing the following:
 *  <Directory "C:\xampp\htdocs\telecom-fc\common">
 *      Options Indexes FollowSymLinks Includes ExecCGI
 *      AllowOverride All
 *      Order allow,deny
 *      Allow from all
 *  </Directory>
 *  Alias /img "C:\xampp\htdocs\telecom-fc\common\assets\img"
 * 2. add a line 'Include "conf/alias/*"' at the end of the file 'httpd.conf' 
 */

class Media extends Component
{
    private $model;

    public $fileStorageInterface;

    public $options = [];

    public function setModel() 
    {
        $this->model = new DynamicModel(['mediaFiles' => null]/*,[
            ['mediaFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 4
        ]*/);
    }

    public function getModel() {
        if ($this->model === null) { $this->setModel(); }
        return $this->model;
    }

    public function find($dir, $options = []) 
    {
        $_fileStorageInterface = $this->fileStorageInterface;

        if (ArrayHelper::isIndexed($dir)) {
            foreach (array_keys($this->options['directories']) as $dir):
                $list = ArrayHelper::merge($list, $this->find($dir));
            endforeach;        
        } else {
            $list = $_fileStorageInterface::findFiles(
                ArrayHelper::getValue($this->options['directories'][$dir], 'path', $dir),
                ArrayHelper::merge(ArrayHelper::getValue($this->options['directories'][$dir], 'findOptions', $options), $options)
            );
        }

        return array_slice($list, 0, ArrayHelper::getValue($options, 'limit', count($list)));
    }

    public function upload($dir = null)
    {
        if ($this->model->addRule([['mediaFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 4])->validate()) {
            return $_fileStorageInterface::uploadFiles($dir, $this->model->mediaFiles);
        } else {
            return false;
        }
    }
}

?>