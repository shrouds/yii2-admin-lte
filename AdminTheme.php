<?php
/**
 * Created by PhpStorm.
 * User: guschin
 * Date: 05.01.2018
 * Time: 15:32
 */

namespace shrouds\admin;

use Yii;
use yii\base\Theme;
use yii\helpers\FileHelper;

class AdminTheme extends Theme
{
    const THEME_NAME = 'adminLte';

    private $themeDirectory;

    /**
     *
     * @throws \yii\base\Exception
     */
    public function init()
    {
        $this->themeDirectory = Yii::getAlias( '@app' ).'/themes/'.self::THEME_NAME;
        $this->setupDirectoryTheme();
        $this->basePath = $this->themeDirectory;
        $this->baseUrl = '@web';
        $this->pathMap = [
            '@app/views' => $this->themeDirectory.'/views',
            '@app/modules' => $this->themeDirectory.'/modules'
        ];
    }

    /**
     *
     * @throws \yii\base\Exception
     */
    protected function setupDirectoryTheme()
    {
        if(!is_dir($this->themeDirectory)){
            if(FileHelper::createDirectory($this->themeDirectory)){
                FileHelper::createDirectory($this->themeDirectory.'/views');
                FileHelper::createDirectory($this->themeDirectory.'/modules');
                FileHelper::copyDirectory(__DIR__.'/views', $this->themeDirectory.'/views');
                if(is_dir(Yii::getAlias( '@app' ).'/views/site')) {
                    FileHelper::copyDirectory(Yii::getAlias('@app') . '/views/site', $this->themeDirectory . '/views/site');
                }
            }
        }
    }

    public function getThemeDirectory()
    {
        return $this->themeDirectory;
    }

}