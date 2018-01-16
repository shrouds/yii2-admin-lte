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
        'css/font-awesome.min.css'
    ];
    public $js = [
        'js/adminlte.min.js',
        //'js/pages/dashboard.js',
        'js/demo.js'
    ];
    public $depends = [
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