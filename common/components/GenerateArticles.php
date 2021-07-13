<?php

namespace common\components;

use common\models\Article;
use common\models\Keyword;
use common\models\Setting;
use common\models\Tools;
use Curl\MultiCurl;

class GenerateArticles
{
    const BASE_GENERATE_API_URL = '/api/v1/generate-articles';

    private $keywords = [];
    private $errors = [];
    private $articles = [];

    private $apiHosts;
    private $apiToken;

    private $mode = 1;
    private $articlesLimit = 10;
    private $chunkLimit = 10;
    private $startPage = 1;
    private $pagesLimit = 1;

    public function generate()
    {
        $this->loadSettings();
        $this->loadConfig();
        $this->parseArticles();
        $this->createArticles();
    }

    public function getMode()
    {
        return $this->mode;
    }

    public function setMode($mode)
    {
        $this->mode = $mode;
    }

    public function getApiHosts()
    {
        return $this->apiHosts;
    }

    public function setApiHost($apiHosts)
    {
        $this->apiHosts = $apiHosts;
    }

    public function getApiToken()
    {
        return $this->apiToken;
    }

    public function setApiToken($apiToken)
    {
        $this->apiToken = $apiToken;
    }

    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;
    }

    public function getKeywords()
    {
        return $this->keywords;
    }

    public function getArticlesLimit()
    {
        return $this->articlesLimit;
    }

    public function setArticlesLimit($articlesLimit)
    {
        $this->articlesLimit = $articlesLimit;
    }

    public function getChunkLimit()
    {
        return $this->chunkLimit;
    }

    public function setChunkLimit($chunkLimit)
    {
        $this->chunkLimit = $chunkLimit;
    }

    public function getStartPage()
    {
        return $this->startPage;
    }

    public function setStartPage($startPage)
    {
        $this->startPage = $startPage;
    }

    public function getPagesLimit()
    {
        return $this->pagesLimit;
    }

    public function setPagesLimit($pagesLimit)
    {
        $this->pagesLimit = $pagesLimit;
    }

    public function getArticles()
    {
        return $this->articles;
    }

    public function setArticles($articles)
    {
        $this->articles = $articles;
    }

    public function loadSettings()
    {
        $settings = Setting::getContentApiSettings();
        $hosts = explode("\r\n", $settings['host']);
        $this->setApiHost($hosts);
        $this->setApiToken($settings['token']);
    }

    public function loadConfig()
    {
        $this->setMode((int)Setting::getArticleParserSettings()['mode']);
        switch ($this->getMode()) {
            case 1:
                $modeSettings = Setting::getArticleParserMode1Settings();
                $this->setArticlesLimit($modeSettings['articlesLimit']);
                $this->setStartPage($modeSettings['startPage']);
                $this->setPagesLimit($modeSettings['pagesLimit']);
                break;
            case 2:
                $modeSettings = Setting::getArticleParserMode2Settings();
                $this->setArticlesLimit($modeSettings['articlesLimit']);
                $this->setStartPage($modeSettings['startPage']);
                $this->setPagesLimit($modeSettings['pagesLimit']);
                break;
            case 3:
                $modeSettings = Setting::getArticleParserMode3Settings();
                $this->setChunkLimit($modeSettings['chunksLimit']);
                $this->setArticlesLimit($modeSettings['articlesLimit']);
                $this->setStartPage($modeSettings['startPage']);
                $this->setPagesLimit($modeSettings['pagesLimit']);
                break;
            case 4:
                $modeSettings = Setting::getArticleParserMode4Settings();
                $this->setArticlesLimit($modeSettings['articlesLimit']);
                $this->setStartPage($modeSettings['startPage']);
                $this->setPagesLimit($modeSettings['pagesLimit']);
                break;
            case 5:
                $modeSettings = Setting::getArticleParserMode5Settings();
                $this->setArticlesLimit($modeSettings['articlesLimit']);
                $this->setStartPage($modeSettings['startPage']);
                $this->setPagesLimit($modeSettings['pagesLimit']);
                break;
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function addErrors($error)
    {
        $this->errors[] = $error;
    }

    public function addArticles($article) {
        $this->articles[] = $article;
    }

    public function parseArticles()
    {
        $multiCurl = new MultiCurl();
        $multiCurl->setOpt(CURLOPT_SSL_VERIFYPEER, 0);
        $multiCurl->setOpt(CURLOPT_CUSTOMREQUEST, 'GET');
        $multiCurl->setOpt(CURLOPT_HTTPGET, true);
        $multiCurl->setOpt(CURLOPT_FRESH_CONNECT, 1);
        $multiCurl->setOpt(CURLOPT_FOLLOWLOCATION, 1);
        $multiCurl->setOpt(CURLOPT_TIMEOUT, 60);
        $multiCurl->setHeader('Authorization', 'Bearer ' . $this->getApiToken());
        $multiCurl->success(function($instance) {
            $keyword = $this->findKeywordByKeyword($instance->response->keyword);
            if (isset($instance->response->content) && !empty($instance->response->content)) {
                $this->addArticles($instance->response);
                $keyword->is_failed = Keyword::IS_NOT_FAILED_STATUS;
            } else {
                $keyword->is_failed = Keyword::IS_FAILED_STATUS;
            }
            $keyword->is_completed = Keyword::IS_COMPLETED_STATUS;
            $keyword->save();
        });
        $multiCurl->error(function($instance) {
            if (isset($instance->response->keyword)) {
                $keyword = $this->findKeywordByKeyword($instance->response->keyword);
                $this->addErrors($keyword->keyword . ': ' . $instance->errorMessage);
                $keyword->is_failed = Keyword::IS_FAILED_STATUS;
                $keyword->is_completed = Keyword::IS_COMPLETED_STATUS;
                $keyword->save();
            }
        });
        $multiCurl->complete(function($instance) {
        });

        $indexHost = 0;
        foreach ($this->getKeywords() as $keyword) {
            if (!isset($this->getApiHosts()[$indexHost])) {
                continue;
            }
            $multiCurl->addGet(trim($this->getApiHosts()[$indexHost], '/') . self::BASE_GENERATE_API_URL, [
                'keyword' => $keyword->keyword,
                'mode' => $this->getMode(),
                'pagesLimit' => $this->getPagesLimit(),
                'articlesLimit' => $this->getArticlesLimit(),
                'chunkLimit' => $this->getChunkLimit(),
                'startPage' => $this->getStartPage()
            ]);
            $indexHost++;
            if ($indexHost === count($this->getArticles())) {
                $indexHost = 0;
            }
        }

        $multiCurl->start();
    }
    
    public function createArticles()
    {
        foreach ($this->getArticles() as $item) {
            $article = GeneratedArticlesUtils::getArticleWithTableOfContents($item->content);
            Article::create(
                Tools::uppercaseFirstLetter($item->keyword),
                Tools::uppercaseFirstLetter($item->keyword),
                $article['content'],
                GeneratedArticlesUtils::getThumb($article['content']),
                $article['tableContents'],
                GeneratedArticlesUtils::generateShortText($article['content']),
                GeneratedArticlesUtils::generateDescription($article['content'])
            );
        }
    }

    private function findKeywordByKeyword($keyword)
    {
        foreach ($this->getKeywords() as $item) {
            if ($item->keyword === $keyword) {
                return $item;
            }
        }

        return false;
    }
}