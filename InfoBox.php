<?php

namespace memclutter\AdminLTE;

use yii\base\InvalidValueException;
use yii\base\Widget;
use yii\helpers\Html;

class InfoBox extends Widget
{
    const BG_AQUA = 'bg-aqua';
    const BG_BLUE = 'bg-blue';
    const BG_BLACK = 'bg-black';
    const BG_GREEN = 'bg-green';
    const BG_YELLOW = 'bg-yellow';
    const BG_RED = 'bg-red';

    public $icon;
    public $iconBg;
    public $text;
    public $number;

    public function init()
    {
        parent::init();

        if (empty($this->icon)) {
            throw new InvalidValueException('Missing info box icon');
        }

        if (empty($this->text) || empty($this->number)) {
            throw new InvalidValueException('Missing info box content');
        }
    }

    public function run()
    {
        $fa = Html::tag('i', '', ['class' => 'fa fa-' . $this->icon . '"></i>']);
        $icon = Html::tag('span', $fa, ['class' => 'info-box-icon ' . $this->iconBg]);
        $text = Html::tag('span', $this->text, ['class' => 'info-box-text']);
        $number = Html::tag('span', $this->number, ['class' => 'info-box-number']);
        $content = Html::tag('div', implode("\n", [$text, $number]), ['class' => 'info-box-content']);
        return Html::tag('div', implode("\n", [$icon, $content]), ['class' => 'info-box']);
    }
}