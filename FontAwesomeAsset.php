<?php
/**
 * Created by PhpStorm.
 * User: guschin
 * Date: 05.01.2018
 * Time: 14:18
 */

namespace shrouds\admin;


use yii\web\AssetBundle;

class FontAwesomeAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@vendor/fortawesome/font-awesome';
    /**
     * @var array
     */
    public $css = ['css/font-awesome.min.css'];
    /**
     * @var array
     */
    public $publishOptions = [
        'forceCopy' => true,
        'only' => [
            'fonts/*',
            'css/*',
        ]
    ];
}