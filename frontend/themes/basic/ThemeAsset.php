<?php

namespace frontend\themes\basic;

use Yii;
use yii\web\AssetBundle;

class ThemeAsset extends AssetBundle
{
    public $basePath = '@frontend/themes/basic';
    public $baseUrl = '@web/themes/basic';
    public $css = [
        //'assets/style/bootstrap/bootstrap.css',
        'assets/style/style.min.css',
    ];
    public $js = [
        //'assets/js/lazyload.min.js',
        'assets/js/main.min.js'
    ];
    public $depends = [
    ];

    public function init()
    {
        parent::init();

        Yii::$app->assetManager->bundles['yii\\bootstrap\\BootstrapAsset'] = [
            'css' => [],
            'js' => []
        ];
    }
}