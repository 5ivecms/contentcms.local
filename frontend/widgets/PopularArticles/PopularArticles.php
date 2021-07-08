<?php

namespace frontend\widgets\PopularArticles;

use common\models\Article;
use common\models\Setting;

class PopularArticles extends \yii\base\Widget
{
    public function run()
    {
        $settings = Setting::getWidgetPopularArticlesSettings();
        if (!$settings['show']) {
            return false;
        }

        $articles = Article::find()->limit($settings['limit'])->orderBy('views DESC')->asArray()->all();
        if (!$articles) {
            return false;
        }

        return $this->render('index', [
            'articles' => $articles,
            'title' => $settings['title']
        ]);
    }
}