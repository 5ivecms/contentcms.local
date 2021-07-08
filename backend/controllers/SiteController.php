<?php

namespace backend\controllers;

use common\components\ContentCreator\ContentCreator;
use common\components\GoogleSearchParser;
use Yii;
use common\models\LoginForm;

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
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionParser()
    {
        $query = 'лечение геморроя дома';
        $articlesNeeded = 10;
        $currentPage = 1;

        $parser = new GoogleSearchParser();
        $contentCreator = new ContentCreator();

        while (count($contentCreator->getArticles()) < $articlesNeeded) {
            $parser->parseLinks($query, $currentPage);
            $links = $parser->getLinks();
            $contentCreator->setArticleLinks($links);
            $contentCreator->create();
            $currentPage++;
        }

        echo '<h1>Всего статей: ' . count($contentCreator->getArticles()) . '</h1>';
        foreach ($contentCreator->getArticles() as $article) {
            echo '<h1>' . $article->getTitle() . '</h1>';
            echo '<h1>' . $article->getUrl() . '</h1>';
            echo '<p><b>Количество чанков: ' . count($article->getChunks()) . '</b></p>';
            echo '<hr>';
        }
        die;
        //$articles = $contentCreator->getArticles();
        /*foreach ($articles as $article) {
            echo '<h1>' . $article->getTitle() . '</h1>';
            echo $article->getContent();
            echo '<hr>';
        }*/
    }
}
