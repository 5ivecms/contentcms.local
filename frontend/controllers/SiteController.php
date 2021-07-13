<?php

namespace frontend\controllers;

use common\models\Article;
use common\models\Setting;

/**
 * Site controller
 */
class SiteController extends BaseController
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $settings = Setting::getHomePageSettings();
        $articles = Article::find()->orderBy('id DESC')->limit($settings['articles.limit'])->asArray()->all();
        $this->setMetaTags($settings['metaTitle'], $settings['metaDescription']);
        $this->setOpenGraph($settings['metaTitle'], $settings['metaDescription']);

        return $this->render('index', [
            'articles' => $articles,
            'settings' => $settings
        ]);
    }

    public function actionSearch($query)
    {
        $articles = Article::find()->where(new \yii\db\Expression('title LIKE :term', [':term' => '%' . $query . '%']))->limit(30)->asArray()->all();
        $pageTitle = 'Поиск "' . $query . '"';
        $this->setMetaTags($pageTitle, $pageTitle);
        $this->setOpenGraph($pageTitle, $pageTitle);

        return $this->render('search', [
            'articles' => $articles,
            'pageTitle' => $pageTitle
        ]);
    }

    public function actionDmca()
    {
        $settings = Setting::getDmcaPageSettings();
        $this->setMetaTags($settings['metaTitle'], $settings['metaDescription']);
        $this->setOpenGraph($settings['metaTitle'], $settings['metaDescription']);

        return $this->render('dmca', [
            'settings' => $settings
        ]);
    }

    public function actionPrivacy()
    {
        $settings = Setting::getPrivacyPageSettings();
        $this->setMetaTags($settings['metaTitle'], $settings['metaDescription']);
        $this->setOpenGraph($settings['metaTitle'], $settings['metaDescription']);

        return $this->render('privacy', [
            'settings' => $settings
        ]);
    }
}
