<?php

namespace backend\controllers;

use common\models\Setting;
use common\models\SitemapGenerator;
use Yii;
use yii\caching\TagDependency;
use yii\web\NotFoundHttpException;

class SettingController extends BaseController
{
    public function actionUpdate()
    {
        $post = Yii::$app->request->post();
        if ($post) {
            foreach ($post['Setting'] as $item) {
                $setting = $this->findModel($item['id']);
                if (is_array($item['value'])) {
                    $item['value'] = json_encode($item['value'], JSON_UNESCAPED_UNICODE);
                }
                $setting->value = $item['value'];
                $setting->save();

                if (isset($post['cache_key'])) {
                    Yii::$app->cache->delete($post['cache_key']);
                }
                if (isset($post['cache_dependency'])) {
                    TagDependency::invalidate(Yii::$app->cache, $post['cache_dependency']);
                }
            }
            if (isset($post['back_url'])) {
                return $this->redirect([$post['back_url']]);
            }
        }

        return $this->redirect(['/admin/default']);
    }

    public function actionBase()
    {
        $themeSettings = Setting::find()->where(['like', 'option', 'themes.'])->all();
        $themeSettings = Setting::prepareSettingsForForms($themeSettings);

        $cacheSettings = Setting::find()->where(['like', 'option', 'cache.'])->all();
        $cacheSettings = Setting::prepareSettingsForForms($cacheSettings);

        $shortTextSettings = Setting::find()->where(['like', 'option', 'shortText.'])->all();
        $shortTextSettings = Setting::prepareSettingsForForms($shortTextSettings);

        $metaDescriptionSettings = Setting::find()->where(['like', 'option', 'metaDescription.'])->all();
        $metaDescriptionSettings = Setting::prepareSettingsForForms($metaDescriptionSettings);

        $brandingSettings = Setting::find()->where(['like', 'option', 'site.'])->all();
        $brandingSettings = Setting::prepareSettingsForForms($brandingSettings);

        return $this->render('base', [
            'themeSettings' => $themeSettings,
            'cacheSettings' => $cacheSettings,
            'shortTextSettings' => $shortTextSettings,
            'metaDescriptionSettings' => $metaDescriptionSettings,
            'brandingSettings' => $brandingSettings
        ]);
    }

    public function actionParser()
    {
        $settings = Setting::find()->where(['like', 'option', 'articleParser.'])->all();
        $settings = Setting::prepareSettingsForForms($settings);

        $contentApiSettings = Setting::find()->where(['like', 'option', 'contentApi.'])->all();
        $contentApiSettings = Setting::prepareSettingsForForms($contentApiSettings);

        return $this->render('parser', [
            'settings' => $settings,
            'contentApiSettings' => $contentApiSettings
        ]);
    }

    public function actionCron()
    {
        $settings = Setting::find()->where(['like', 'option', 'cron.'])->all();
        $settings = Setting::prepareSettingsForForms($settings);

        return $this->render('cron', [
            'settings' => $settings
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Setting::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionClearCache()
    {
        Yii::$app->cache->flush();
        Yii::$app->session->setFlash('success', 'Кеш очищен');

        return $this->redirect(['setting/base']);
    }

    public function actionGenerateToken()
    {
        $token = md5(Yii::$app->request->remoteIP . microtime());
        $setting = Setting::findOne(['option' => 'cron.token']);
        $setting->value = $token;
        $setting->save();

        $post = Yii::$app->request->post();
        if (isset($post['cache_key'])) {
            Yii::$app->cache->delete($post['cache_key']);
        }
        if (isset($post['cache_dependency'])) {
            TagDependency::invalidate(Yii::$app->cache, $post['cache_dependency']);
        }
        if (isset($post['back_url'])) {
            return $this->redirect([$post['back_url']]);
        }

        return $token;
    }

    public function actionCreateSitemap()
    {
        SitemapGenerator::create();

        Yii::$app->session->setFlash('success', 'Карта сайта создана');

        return $this->redirect(['setting/base']);
    }

    public function actionPages()
    {
        return $this->render('pages', []);
    }

    public function actionPageHome()
    {
        $settings = Setting::find()->where(['like', 'option', 'homePage.'])->all();
        $settings = Setting::prepareSettingsForForms($settings);

        return $this->render('pages/_home', [
            'settings' => $settings
        ]);
    }

    public function actionPageArticlesCatalog()
    {
        $settings = Setting::find()->where(['like', 'option', 'articlesCatalog.'])->all();
        $settings = Setting::prepareSettingsForForms($settings);

        return $this->render('pages/_articlesCatalog', [
            'settings' => $settings
        ]);
    }

    public function actionPageArticle()
    {
        $settings = Setting::find()->where(['like', 'option', 'article.'])->all();
        $settings = Setting::prepareSettingsForForms($settings);

        return $this->render('pages/_article', [
            'settings' => $settings
        ]);
    }

    public function actionPageDmca()
    {
        $settings = Setting::find()->where(['like', 'option', 'page.dmca'])->all();
        $settings = Setting::prepareSettingsForForms($settings);

        return $this->render('pages/_dmca', [
            'settings' => $settings
        ]);
    }

    public function actionPagePrivacy()
    {
        $settings = Setting::find()->where(['like', 'option', 'page.privacy'])->all();
        $settings = Setting::prepareSettingsForForms($settings);

        return $this->render('pages/_privacy', [
            'settings' => $settings
        ]);
    }

    public function actionWidgets()
    {
        return $this->render('widgets', []);
    }

    public function actionWidgetLastArticles()
    {
        $settings = Setting::find()->where(['like', 'option', 'widget.lastArticles.'])->all();
        $settings = Setting::prepareSettingsForForms($settings);

        return $this->render('widgets/_widgetLastArticles', [
            'settings' => $settings
        ]);
    }

    public function actionWidgetPopularArticles()
    {
        $settings = Setting::find()->where(['like', 'option', 'widget.popularArticles.'])->all();
        $settings = Setting::prepareSettingsForForms($settings);

        return $this->render('widgets/_widgetPopularArticles', [
            'settings' => $settings
        ]);
    }
}