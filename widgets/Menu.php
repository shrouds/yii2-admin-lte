<?php
/**
 * Created by PhpStorm.
 * User: guschin
 * Date: 10.01.2018
 * Time: 14:22
 */

namespace shrouds\admin\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;

class Menu extends Widget
{

    public $items = [];

    public $options = [];

    public $enableUserPanel = true;

    public $userPanelOptions = [];

    public $enableSearchForm = true;

    public $content;

    public $menuTemplate = '<ul class="sidebar-menu" data-widget="tree"> {CONTENT} </ul>';


    public function run ()
    {
        if ($this->enableUserPanel){
            $this->renderUserPanel();
        }
        if ($this->enableSearchForm){
            $this->renderSearchForm();
        }
        $this->content .= strtr($this->menuTemplate, ['{CONTENT}' => $this->renderItems($this->items)]);

        echo Html::tag('section', $this->content, ['class' => 'sidebar']);
    }

    /**
     * Необходимо доработать
     */
    protected function renderUserPanel()
    {
        $tag['image'] = Html::tag(
            'div',
                Html::img($this->userPanelOptions['image'], ['class' => 'img-circle']),
                ['class' => 'pull-left image']);
        $tag['user'] = Html::tag(
            'div',
                Html::tag('p','UserName').Html::a(Html::tag('i','', ['class' => 'fa fa-circle text-success']).'Online'),
                ['class' => 'pull-left info']);
        $this->content = Html::tag('div', $tag['image'].$tag['user'], ['class' => 'user-panel']);
    }

    protected function renderSearchForm()
    {
        $form['begin'] = Html::beginForm('#', 'get', ['class' => 'sidebar-form']);
        $form['content'] = Html::tag('div', Html::input('text', 'q', '', ['class' => 'form-control','placeholder' => 'Search...']).Html::tag('span', Html::button(Html::tag('i','',['class' => 'fa fa-search']), ['type' => 'submit', 'name' => 'search', 'id' => 'search-btn', 'class' => 'btn btn-flat']), ['class' => 'input-group-btn']), ['class' => 'input-group']);
        $form['end'] = Html::endForm();
        $this->content .= $form['begin'].$form['content'].$form['end'];
    }

    protected function renderItems($items)
    {
        $line = [];
        foreach ($items as $item)
        {
            $params = [];
            if($this->isItemActive($item)){
                $params['class'] = 'active';
            }
            $itemConfig = [];
            if(isset($item['options']['icon']) && !empty($item['options']['icon']))
            {
                $itemConfig['icon'] = Html::tag('i', '', ['class' => $item['options']['icon']]);
            }
            $itemConfig['label'] = Html::tag('span', $item['label']);
            if (!empty($item['items']) && is_array($item['items']))
            {
                $params['class'] .= ' treeview';
                $itemConfig['rightBox'] = Html::tag('span', Html::tag('span', '', ['class' => 'fa fa-angle-left pull-right']));
                $itemConfig['submenu'] = Html::tag('ul', $this->renderItems($item['items']), ['class' => 'treeview-menu']);
            }
            if(!empty($item['url']) && is_array($item['url'])){
                $content = Html::a($itemConfig['icon'].$itemConfig['label'].$itemConfig['rightBox'], \Yii::$app->urlManager->createUrl($item['url'])).$itemConfig['submenu'];
            }else{
                $params['class'] = 'header';
                $content = $item['label'];
            }

                $line[] = Html::tag('li', $content, $params);
        }
        return implode("\n", $line);

    }

    protected function isItemActive($item)
    {
        if (isset($item['url']) && is_array($item['url']) && isset($item['url'][0])) {
            $route = Yii::getAlias($item['url'][0]);
            if ($route[0] !== '/' && Yii::$app->controller) {
                $route = Yii::$app->controller->module->getUniqueId() . '/' . $route;
            }
            if (ltrim($route, '/') !== Yii::$app->controller->getRoute()) {
                return false;
            }
            unset($item['url']['#']);

            return true;
        }

        return false;
    }

}