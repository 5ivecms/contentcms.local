<?php

namespace frontend\widgets\LastArticles;

use common\models\Article;
use common\models\Setting;

class LastArticles extends \yii\base\Widget
{
    public function run()
    {
        $settings = Setting::getWidgetLastArticlesSettings();
        if (!$settings['show']) {
            return false;
        }

        $articles = Article::find()->limit($settings['limit'])->orderBy('id DESC')->asArray()->all();
        if (!$articles) {
            return false;
        }

        return $this->render('index', [
            'articles' => $articles,
            'title' => $settings['title']
        ]);
    }
}