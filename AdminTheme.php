<?php
/**
 * Created by PhpStorm.
 * User: guschin
 * Date: 05.01.2018
 * Time: 15:32
 */

namespace shrouds\admin;


use yii\base\Theme;

class AdminTheme extends Theme
{
    public function init()
    {
        //parent::init();
        $this->basePath = __DIR__;
        $this->baseUrl = '@web';
    }

}