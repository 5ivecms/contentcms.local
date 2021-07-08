<?php

namespace api\modules\v1\controllers;

use common\models\Article;
use common\models\Keyword;

class StatisticController extends BaseController
{
    public function actionIndex()
    {
        $statistic['countArticles'] = Article::find()->count();
        $statistic['countKeywords'] = Keyword::find()->count();
        $statistic['countNewKeywords'] = Keyword::find()->where(['is_completed' => Keyword::IS_NOT_COMPLETED_STATUS])->count();

        return $statistic;
    }
}