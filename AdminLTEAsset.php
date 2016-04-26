<?php

namespace memclutter\AdminLTE;

use yii\web\AssetBundle;

class AdminLTEAsset extends AssetBundle
{
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
            $css
        ];

        $js = YII_DEBUG ? 'js/app.js' : 'js/app.min.js';
        $this->js = [
            $js
        ];
    }
}
