<?php
/**
 * Created by PhpStorm.
 * User: guschin
 * Date: 15.01.2018
 * Time: 13:52
 */

namespace shrouds\admin\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;

class Alert extends Widget
{
    public $alertTypes = [
        'error'   => 'alert alert-danger alert-dismissible',
        'success' => 'alert alert-success alert-dismissible',
        'info'    => 'alert alert-info alert-dismissible',
        'warning' => 'alert alert-warning alert-dismissible'
    ];

    public $iconTypes = [
        'error'   => 'icon fa fa-ban',
        'success' => 'icon fa fa-check',
        'info'    => 'icon fa fa-info',
        'warning' => 'icon fa fa-warning'
    ];

    public function run()
    {
        $session = Yii::$app->session;
        $flashes = $session->getAllFlashes();

        foreach ($flashes as $type => $flash) {
            if (!isset($this->alertTypes[$type])) {
                continue;
            }

            foreach ((array) $flash as $i => $message) {
                $button = Html::button('&times;', ['type' => 'button', 'class' => 'close', 'data-dismiss' => 'alert', 'aria-hidden' => 'true']);
                $header = Html::tag('h4', Html::tag('i', '', ['class' => $this->iconTypes[$type]]).strtoupper($type));
                echo Html::tag('div', $button.$header.$message, ['class' => $this->alertTypes[$type]]);
            }

            $session->removeFlash($type);
        }
    }

}