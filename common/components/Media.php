<?php
namespace common\components;

use Yii;
use yii\base\Component;
use yii\base\DynamicModel;

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

    private $_model;

    public $fileStorageInterface;

    public function __construct(FileStorageInterface $fileStorageInterface, $config = [])
    {
        parent::__construct($config);
    }

    public function createModel(/*$attributes = ['imageFile'], $extensions = 'png, jpg, jpeg'*/) 
    {        
        $this->$_model = new DynamicModel(compact($attributes));
    }

    public function find($dir, $options = []) 
    {
        $_fileStorageInterface = $this->fileStorageInterface;
        return $_fileStorageInterface::findFiles($dir, $options);
    }

    public function upload() {}

}
?>

