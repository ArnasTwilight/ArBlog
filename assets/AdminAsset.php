<?php

namespace app\assets;

use yii\web\AssetBundle;

class AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'public/css/normalize.css',
        'public/css/admin.css',
    ];
    public $js = [
    ];
    public $depends = [
    ];
}
