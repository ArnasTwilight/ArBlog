<?php

namespace app\assets;

use yii\web\AssetBundle;

class PublicAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'public/css/normalize.css',
        'public/css/style.css',
    ];
    public $js = [
    ];
    public $depends = [
    ];
}
