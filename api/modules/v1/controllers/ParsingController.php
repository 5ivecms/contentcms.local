<?php

namespace api\modules\v1\controllers;

use common\components\GenerateArticles;
use common\models\Keyword;
use common\models\Setting;

class ParsingController extends BaseController
{
    public function actionIndex()
    {
        $start = microtime(true);

        $settings = Setting::getContentApiSettings();
        $hosts = explode("\r\n", $settings['host']);
        $keywords = Keyword::find()
            ->where(['is_completed' => Keyword::IS_NOT_COMPLETED_STATUS])
            ->andWhere(['is_failed' => Keyword::IS_NOT_FAILED_STATUS])
            ->orderBy('id DESC')
            ->limit(count($hosts))
            ->all();
        $generateArticles = new GenerateArticles();
        $generateArticles->setKeywords($keywords);
        $generateArticles->generate();
        $finish = microtime(true);

        $delta = $finish - $start;

        echo 'Время выполнения: ' .  $delta . ' сек.';

        die;
    }
}