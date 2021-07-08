<?php

namespace frontend\controllers;

use common\models\Themes;
use Yii;
use yii\base\Theme;
use yii\helpers\Url;
use yii\web\Controller;

class BaseController extends Controller
{
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            $theme = Themes::current();
            Yii::$app->view->theme = new Theme([
                'basePath' => '@frontend/themes/' . $theme,
                'baseUrl' => '@web/themes/' . $theme,
                'pathMap' => [
                    '@frontend/views' => '@frontend/themes/' . $theme . '/views',
                    '@frontend/widgets' => '@frontend/themes/' . $theme . '/widgets',
                ]]);
            return true;
        }
        return false;
    }

    public function setMetaTags($metaTitle, $metaDescription = '')
    {
        Yii::$app->view->title = $metaTitle;
        Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $metaDescription]);
        Yii::$app->view->registerLinkTag(['rel' => 'canonical', 'href' => $this->getCanonicalUrl()]);
    }

    public function setOpenGraph($title, $description = '', $image = '')
    {
        $image = !empty($image) ? Yii::$app->request->hostInfo . $image : $this->getSitePreview();
        Yii::$app->view->registerMetaTag(['property' => 'og:site_name', 'content' => Yii::$app->getRequest()->serverName]);
        Yii::$app->view->registerMetaTag(['property' => 'og:url', 'content' => $this->getCanonicalUrl()]);
        Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => $title]);
        Yii::$app->view->registerMetaTag(['property' => 'og:image', 'content' => $image]);
        if (!empty($description)) {
            Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => $description]);
        }
    }

    public function getCanonicalUrl()
    {
        return trim(Yii::$app->request->hostInfo . strtok(Url::canonical(), '?'), '/');
    }

    private function getSitePreview()
    {
        return Yii::$app->request->hostInfo . '/themes/' . \common\models\Themes::current() . '/assets/images/preview.jpg';
    }
}