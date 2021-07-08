<?php

namespace frontend\controllers;

use common\models\Article;
use common\models\Setting;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

class ArticleController extends BaseController
{
    public function actionIndex($page = 1)
    {
        $settings = Setting::getArticleCatalogPageSettings();
        $query = Article::find();
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => $settings['articles.limit'], 'pageSizeParam' => false, 'forcePageParam' => false,]);
        $articles = $query->offset($pages->offset)->orderBy('id DESC')->limit($pages->limit)->asArray()->all();

        if ($page > 1) {
            $settings['metaTitle'] = $settings['metaTitle'] . '. Страница: ' . $page;
            $settings['h1'] = $settings['h1'] . '. Страница: ' . $page;
        }

        $this->setMetaTags($settings['metaTitle'], $settings['metaDescription']);
        $this->setOpenGraph($settings['metaTitle'], $settings['metaDescription']);

        return $this->render('index', [
            'articles' => $articles,
            'settings' => $settings,
            'pages' => $pages
        ]);
    }

    public function actionView($id, $slug = '')
    {
        $settings = Setting::getArticlePageSettings();
        $article = Article::find()->where(['id' => $id])->one();
        if (!$article || empty($slug) || $slug !== $article->slug) {
            throw new NotFoundHttpException('Ошибка! Такой страницы не сущетвует');
        }

        $article->updateCounters(['views' => 1]);
        $article = ArrayHelper::toArray($article);

        $this->setMetaTags($article['meta_title'], $article['meta_description']);
        $this->setOpenGraph($article['meta_title'], $article['meta_description'], $article['thumb']);

        $related = Article::getRelated($article['id'], $settings['related.limit']);

        return $this->render('view', [
            'article' => $article,
            'settings' => $settings,
            'related' => $related
        ]);
    }
}