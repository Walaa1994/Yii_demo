<?php

namespace app\widgets;

use yii\base\Widget;
use yii\bootstrap5\Html;

class SidebarNavWidget extends Widget
{
    public $items = [];

    public function run()
    {
        $navItems = $this->renderNavItems($this->items);

        $sidebarNav = Html::tag('ul', $navItems, ['class' => 'sidebar-nav', 'id' => 'sidebar-nav']);
        $sidebar = Html::tag('aside', $sidebarNav, ['class' => 'sidebar', 'id' => 'sidebar']);

        return $sidebar;
    }

    protected function renderNavItems($items)
    {
        $navItems = '';

        foreach ($items as $item) {
            $navItems .= $this->renderNavItem($item);
        }

        return $navItems;
    }

    protected function renderNavItem($item)
    {
        $options = $item['options'] ?? [];
        $navItem = Html::beginTag('li', $options);

        $navItem .= $this->renderLinkNavItem($item);

        $navItem .= Html::endTag('li');

        return $navItem;
    }

    protected function renderLinkNavItem($item)
    {
        $linkOptions = $item['linkOptions'] ?? [];
        $linkContent = $this->renderLinkContent($item);

        return Html::a($linkContent, $item['url'] ?? '#', $linkOptions);
    }

    protected function renderLinkContent($item)
    {
        $icon = isset($item['icon']) ? Html::tag('i', '', ['class' => $item['icon']]) : '';
        $label = isset($item['label']) ? Html::tag('span', $item['label']) : '';

        return $icon . $label;
    }
}
