<?php
/**
 * Created by PhpStorm.
 * User: guschin
 * Date: 05.01.2018
 * Time: 14:18
 */

namespace shrouds\admin;


use yii\web\AssetBundle;

class AdminTemplateAsset extends AssetBundle
{
    public $css = [
        'css/AdminLTE.min.css',
        'css/ionicons.min.css',
        'css/skins/_all-skins.min.css',
    ];
    public $js = [
        'js/adminlte.min.js',
        'js/demo.js'
    ];
    public $depends = [
        'shrouds\admin\FontAwesomeAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
     public function init()
     {
         //parent::init();
         $this->sourcePath = __DIR__.'/assets';
         //print_r($this->sourcePath);
     }
}