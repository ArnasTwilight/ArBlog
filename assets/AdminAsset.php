<?php

namespace app\assets;

use yii\web\AssetBundle;

class AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        [
            'href' => 'public/favico/faviconAP.ico',
            'rel' => 'icon',
            'sizes' => '32x32',
        ],
        'public/css/normalize.css',
        'public/css/admin.css',
    ];
    public $js = [
        'public/js/script.js',
    ];
    public $depends = [
    ];
}
