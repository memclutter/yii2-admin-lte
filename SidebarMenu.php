<?php

namespace memclutter\AdminLTE;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Menu;

class SidebarMenu extends Menu
{
    /**
     * @inheritdoc
     */
    public $activateParents = true;

    /**
     * @inheritdoc
     */
    public $encodeLabels = false;

    /**
     * @inheritdoc
     */
    public $submenuTemplate = "\n<ul class=\"treeview-menu\">\n{items}\n</ul>\n";

    /**
     * @inheritdoc
     */
    public $linkTemplate = '<a href="{url}">{icon} {label} {angle}</a>';

    /**
     * @inheritdoc
     */
    public $labelTemplate = '{icon} {label}';

    /**
     * @var string Menu header
     */
    public $header;

    /**
     * @var string icon template
     */
    public $iconTemplate = '<i class="fa fa-{name}"></i>';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // add css class 'sidebar-menu'
        if (isset($this->options['class'])) {
            if (is_array($this->options['class']) && !in_array('sidebar-menu', $this->options['class'])) {
                $this->options['class'][] = 'sidebar-menu';
            } elseif (false === strpos($this->options['class'], 'sidebar-menu')) {
                $this->options['class'] .= ' sidebar-menu';
            }
        } else {
            $this->options['class'] = 'sidebar-menu';
        }

        // add first header item
        if (!empty($this->header)) {
            $this->items = ArrayHelper::merge([
                ['label' => $this->header, 'options' => ['class' => 'header']],
            ], $this->items);
        }
    }

    /**
     * @inheritdoc
     */
    protected function normalizeItems($items, &$active)
    {
        foreach ($items as $i => $item) {
            if (isset($item['visible']) && !$item['visible']) {
                unset($items[$i]);
                continue;
            }
            if (!isset($item['label'])) {
                $item['label'] = '';
            }
            $encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
            $items[$i]['label'] = $encodeLabel ? Html::encode($item['label']) : $item['label'];
            $hasActiveChild = false;
            if (isset($item['items'])) {

                // add css class for treeview
                if (isset($item['options']['class'])) {
                    if (is_array($item['options']['class']) && !in_array('treeview', $item['options']['class'])) {
                        $items[$i]['options']['class'][] = 'treeview';
                    } elseif (false !== strpos($item['options']['class'], 'treeview')) {
                        $items[$i]['options']['class'] .= ' treeview';
                    }
                } else {
                    $items[$i]['options']['class'] = 'treeview';
                }

                $items[$i]['items'] = $this->normalizeItems($item['items'], $hasActiveChild);
                if (empty($items[$i]['items']) && $this->hideEmptyItems) {
                    unset($items[$i]['items']);
                    if (!isset($item['url'])) {
                        unset($items[$i]);
                        continue;
                    }
                }
            }
            if (!isset($item['active'])) {
                if ($this->activateParents && $hasActiveChild || $this->activateItems && $this->isItemActive($item)) {
                    $active = $items[$i]['active'] = true;
                } else {
                    $items[$i]['active'] = false;
                }
            } elseif ($item['active']) {
                $active = true;
            }
        }

        return array_values($items);
    }

    /**
     * @inheritdoc
     */
    protected function renderItem($item)
    {
        if (isset($item['url'])) {
            $template = ArrayHelper::getValue($item, 'template', $this->linkTemplate);

            return strtr($template, [
                '{icon}' => $this->renderIcon($item),
                '{url}' => Html::encode(Url::to($item['url'])),
                '{label}' => Html::tag('span', $item['label']),
                '{angle}' => isset($item['items']) && !empty($item['items'])
                    ? '<i class="fa fa-angle-left pull-right"></i>' : '',
            ]);
        } else {
            $template = ArrayHelper::getValue($item, 'template', $this->labelTemplate);

            return strtr($template, [
                '{icon}' => $this->renderIcon($item),
                '{label}' => Html::tag('span', $item['label']),
            ]);
        }
    }

    protected function renderIcon($item)
    {
        if (isset($item['icon'])) {
            return strtr($this->iconTemplate, [
                '{name}' => $item['icon'],
            ]);
        } else {
            return '';
        }
    }
}