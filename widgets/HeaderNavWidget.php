<?php

namespace app\widgets;

use Yii;
use yii\bootstrap5\Nav;
use yii\bootstrap5\Html;

class HeaderNavWidget extends Nav
{
    public $items = [];
    /**
     * Renders the widget.
     * @return string the rendering result.
     */
    public function run(): string
    {
        Html::addCssClass($this->options, 'header-nav ms-auto');

        $items = $this->renderItems($this->items);

        return Html::tag('nav', $items, $this->options);
    }

    /**
     * Renders the items in the menu.
     * @param array $items the menu items to render.
     * @return string the rendering result.
     */
    public function renderItems(): string
    {
        $lines = [];
        foreach ($this->items as $i => $item) {
            $lines[] = $this->renderItem($item);
        }

        return Html::tag('ul', implode("\n", $lines), ['class' => 'd-flex align-items-center']);

    }

    /**
     * Renders an individual item in the menu.
     * @param array $item the item to render.
     * @return string the rendering result.
     */
    public function renderItem($item): string
    {
        if (isset($item['items'])) {
            Html::addCssClass($item['options'], 'nav-item dropdown pe-3');

            $dropdownItems = $this->renderDropdown($item['items'], $item);
            $dropdown = Html::tag('ul', $dropdownItems, ['class' => 'dropdown-menu dropdown-menu-end dropdown-menu-arrow profile']);

            $linkOptions = $item['linkOptions'] ?? [];
            Html::addCssClass($linkOptions, 'nav-link nav-profile d-flex align-items-center pe-0');

            // Add the data attributes to the linkOptions
            $linkOptions['data-bs-toggle'] = 'dropdown';
            $linkOptions['aria-expanded'] = 'true';

            // Check if an image is provided
            $image = isset($item['image']) ? Html::img($item['image'], $item['imageOptions'] ?? []) : '';

            // Add the $label in a <span> element
            $label = isset($item['label']) ? '<span class="d-none d-md-block dropdown-toggle ps-2">' . $item['label'] . '</span>' : '';

            $linkContent = $image . $label;
            $link = Html::a($linkContent, $item['url'] ?? '#', $linkOptions);

            return Html::tag('li', $link . $dropdown, $item['options']);

        }

        return parent::renderItem($item);
    }

    /**
     * Renders the dropdown menu.
     * @param array $items the dropdown items.
     * @param array $parentItem the parent menu item.
     * @return string the rendering result.
     */
    protected function renderDropdown($items, $parentItem): string
    {
        $lines = [];
        foreach ($items as $item) {
            $lines[] = $this->renderDropdownItem($item);
        }

        return implode("\n", $lines);
    }

    /**
     * Renders a dropdown item.
     * @param array $item the item to render.
     * @return string the rendering result.
     */
    protected function renderDropdownItem($item)
    {
        $encodeLabel = $item['encode'] ?? $this->encodeLabels;
        $label = $encodeLabel ? Html::encode($item['label']) : $item['label'];
        $url = $item['url'] ?? '#';
        $options = $item['linkOptions'] ?? [];
        Html::addCssClass($options, 'dropdown-item d-flex align-items-center');

        return Html::tag('li', Html::a($label, $url, $options));
    }
}
