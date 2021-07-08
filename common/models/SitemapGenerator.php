<?php

namespace common\models;

use samdark\sitemap\Index;
use samdark\sitemap\Sitemap;
use Yii;

class SitemapGenerator
{
    const QUERY_LIMIT = 25000;

    const INDEX_SITEMAP_FILE_NAME = '/sitemap-index.xml';
    const ARTICLES_SITEMAP_FILE_NAME = '/sitemap_articles.xml';

    public static function create()
    {
        if (!file_exists(self::sitemapPath())) {
            mkdir(self::sitemapPath(), 0755);
        }

        $index = new Index(self::sitemapPath() . self::INDEX_SITEMAP_FILE_NAME);

        $articlesSitemapUrls = self::createArticlesSitemap();
        if ($articlesSitemapUrls) {
            foreach ($articlesSitemapUrls as $sitemapUrl) {
                $index->addSitemap($sitemapUrl);
            }
        }

        $index->write();
    }

    private static function createArticlesSitemap()
    {
        $sitemap = new Sitemap(self::sitemapPath() . '/' . self::ARTICLES_SITEMAP_FILE_NAME);
        $count = Article::find()->count();
        $j = floor($count / self::QUERY_LIMIT);
        for ($i = 0; $i <= $j; $i++) {
            $offset = $i * self::QUERY_LIMIT;
            $articles = Article::find()->offset($offset)->limit(self::QUERY_LIMIT)->asArray()->all();
            foreach ($articles as $article) {
                $sitemap->addItem(Yii::$app->request->hostInfo . Yii::$app->urlManagerFrontEnd->createUrl(['article/view', 'id' => $article['id'], 'slug' => $article['slug']]));
            }
        }

        $sitemap->write();

        return $sitemap->getSitemapUrls(self::sitemapUrl());
    }

    private static function sitemapPath()
    {
        return Yii::getAlias('@frontendWebroot') . '/sitemap/';
    }

    private static function sitemapUrl()
    {
        return Yii::$app->request->hostInfo . '/sitemap/';
    }
}