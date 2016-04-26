<?php

namespace memclutter\AdminLTE;

use memclutter\ICheck\ICheckAsset;
use yii\web\AssetBundle;

class AdminLTELoginAsset extends AssetBundle
{
    public static $iCheckSkin;

    public $depends = [
        'memclutter\AdminLTE\AdminLTEAsset',
        'memclutter\ICheck\ICheckAsset',
    ];

    public function init()
    {
        parent::init();

        if (empty(self::$iCheckSkin)) {
            self::$iCheckSkin = ICheckAsset::SKIN_ALL;
        }

        ICheckAsset::$skin = self::$iCheckSkin;
    }

    /**
     * @inheritdoc
     */
    public function registerAssetFiles($view)
    {
        parent::registerAssetFiles($view);
        $view->registerJs('$("input").iCheck();');
    }
}