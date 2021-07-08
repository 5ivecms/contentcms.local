<?php

namespace console\controllers;

use common\components\GenerateArticles;
use common\models\Keyword;
use common\models\Setting;
use common\models\Tools;

class KeywordController extends \yii\console\Controller
{
    public function actionParse()
    {
        $settings = Setting::getCronSettings();
        if (!$settings['keywords.enabled']) {
            return 1;
        }

        Tools::removeTimeout();

        $keywords = Keyword::find()->where(['is_completed' => Keyword::IS_NOT_COMPLETED_STATUS])->andWhere(['is_failed' => Keyword::IS_NOT_FAILED_STATUS])->orderBy('id DESC')->limit($settings['keywords.limit'])->all();
        $generateArticles = new GenerateArticles();
        $generateArticles->setKeywords($keywords);
        $generateArticles->generate();

        return 0;
    }
}