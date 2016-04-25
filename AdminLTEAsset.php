<?php

namespace memclutter\AdminLTE;

use yii\web\AssetBundle;

class AdminLTEAsset extends AssetBundle
{
    public $sourcePath = '@bower/admin-lte/dist';
    public $baseUrl = '@web';
    public $css = [
        'css/AdminLTE.css',
    ];
    public $js = [
        'js/app.min.js',
    ];
    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
