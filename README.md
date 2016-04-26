# Admin LTE for Yii2
Yii2 love admin lte theme! Install it
```sh
composer require "memclutter/yii2-admin-lte:dev-master"
```
use it
```php
<?php

use memclutter\AdminLTE\AdminLTEAsset;

/* @var $this \yii\web\View */

AdminLTEAsset::register($this);
```
or for login page
```php
<?php

use memclutter\ICheck\ICheckAsset;
use memclutter\AdminLTE\AdminLTELoginAsset;

/* @var $this \yii\web\View */

AdminLTELoginAsset::$iCheckSkin = ICheckAsset::SKIN_SQUARE_BLUE;
AdminLTELoginAsset::register($this);
```