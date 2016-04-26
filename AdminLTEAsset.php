<?php

namespace memclutter\AdminLTE;

use yii\web\AssetBundle;

class AdminLTEAsset extends AssetBundle
{
    const SKIN_ALL = '_all-skins';
    const SKIN_BLACK = 'skin-black';
    const SKIN_BLACK_LIGHT = 'skin-black-light';
    const SKIN_BLUE = 'skin-blue';
    const SKIN_BLUE_LIGHT = 'skin-blue-light';
    const SKIN_GREEN = 'skin-green';
    const SKIN_GREEN_LIGHT = 'skin-green-light';
    const SKIN_PURPLE = 'skin-purple';
    const SKIN_PURPLE_LIGHT = 'skin-purple-light';
    const SKIN_RED = 'skin-red';
    const SKIN_RED_LIGHT = 'skin-red-light';
    const SKIN_YELLOW = 'skin-yellow';
    const SKIN_YELLOW_LIGHT = 'skin-yellow-light';

    public static $skin;

    public $sourcePath = '@bower/admin-lte/dist';
    public $baseUrl = '@web';
    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $css = YII_DEBUG ? 'css/AdminLTE.css' : 'css/AdminLTE.min.css';
        $this->css = [
            $css,
        ];

        if (!empty(self::$skin)) {
            $cssSkin = YII_DEBUG ? ('css/' . self::$skin . '.css') : ('css/' . self::$skin . '.min.css');
            $this->css[] = [$cssSkin];
        }

        $js = YII_DEBUG ? 'js/app.js' : 'js/app.min.js';
        $this->js = [
            $js
        ];
    }

    public static function getBodyCssClass()
    {
        if (!empty(self::$skin)) {
            return self::$skin;
        } else {
            return null;
        }
    }
}
