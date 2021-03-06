<?php

return [
    'class' => 'yii\web\UrlManager',
    'baseUrl' => '',
    'hostInfo' => '',

    'enablePrettyUrl' => true,
    'enableStrictParsing' => true,
    'showScriptName' => false,

    'rules' => [
        '/' => 'site/index',
        '/search' => 'site/search',
        '/dmca' => 'site/dmca',
        '/privacy' => 'site/privacy',
        'post/<id:[0-9]+>-<slug:[-a-z0-9]+>' => 'article/view',
        '/articles' => 'article/index',
    ],
];