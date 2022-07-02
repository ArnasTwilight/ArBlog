<?php

namespace app\assets;

use yii\web\AssetBundle;

class PublicAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'public/css/normalize.css',
        ['public/css/style.css', 'id' => 'theme'],
    ];
    public $js = [
        'public/js/theme.js',
    ];
    public $depends = [
    ];
}