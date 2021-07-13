<?php

namespace common\models;

use Yii;
use yii\caching\TagDependency;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "setting".
 *
 * @property int $id
 * @property string|null $option
 * @property string|null $value
 * @property string|null $default
 * @property string|null $label
 */
class Setting extends \yii\db\ActiveRecord
{
    const HOME_PAGE_CACHE_KEY = 'settings.homePage';
    const ARTICLE_CATALOG_PAGE_CACHE_KEY = 'settings.articlesCatalog';
    const ARTICLE_PAGE_CACHE_KEY = 'settings.article';
    const WIDGET_LAST_ARTICLES_CACHE_KEY = 'widget.lastArticles';
    const WIDGET_POPULAR_ARTICLES_CACHE_KEY = 'widget.popularArticles';
    const CRON_SETTINGS_CACHE_KEY = 'settings.cron';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'setting';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['value', 'default', 'label'], 'string'],
            [['option'], 'string', 'max' => 255],
            [['option'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'option' => 'Option',
            'value' => 'Value',
            'default' => 'Default',
            'label' => 'Label',
        ];
    }

    public static function getGroupSettings($group = '', $groupKey = true)
    {
        if (empty($group)) {
            return false;
        }

        $settings = Setting::find()->where(['like', 'option', $group . '.'])->asArray()->all();
        if (!$settings) {
            return false;
        }
        $settings = ArrayHelper::map($settings, 'option', 'value');
        foreach ($settings as $k => $setting) {
            if (self::isJson($setting)) {
                $settings[$k] = json_decode($setting);
            }
        }

        if (!$groupKey) {
            $result = [];
            foreach ($settings as $k => $setting) {
                $newKey = str_replace($group . '.', '', $k);
                $result[$newKey] = $setting;
            }
            $settings = $result;
        }

        return $settings;
    }

    public static function isJson($string)
    {
        json_decode($string);

        return (json_last_error() == JSON_ERROR_NONE);
    }

    public static function prepareSettingsForForms($settings)
    {
        if (!$settings) {
            return false;
        }
        $settings = ArrayHelper::index($settings, 'option');
        foreach ($settings as $k => $setting) {
            if (Setting::isJson($setting->value)) {
                $settings[$k]->value = json_decode($setting->value);
            }
        }

        return $settings;
    }

    public static function getContentApiSettings()
    {
        return self::getGroupSettings('contentApi', false);
    }

    public static function getArticleParserSettings()
    {
        return self::getGroupSettings('articleParser', false);;
    }

    public static function getArticleParserMode1Settings()
    {
        return self::getGroupSettings('articleParser.mode1', false);
    }

    public static function getArticleParserMode2Settings()
    {
        return self::getGroupSettings('articleParser.mode2', false);
    }

    public static function getArticleParserMode3Settings()
    {
        return self::getGroupSettings('articleParser.mode3', false);
    }

    public static function getArticleParserMode4Settings()
    {
        return self::getGroupSettings('articleParser.mode4', false);
    }

    public static function getArticleParserMode5Settings()
    {
        return self::getGroupSettings('articleParser.mode5', false);
    }

    public static function getHomePageSettings()
    {
        return self::getGroupSettings('homePage', false);
    }

    public static function getArticleCatalogPageSettings()
    {
        return self::getGroupSettings('articlesCatalog', false);
    }

    public static function getArticlePageSettings()
    {
        return self::getGroupSettings('article', false);
    }

    public static function getWidgetLastArticlesSettings()
    {
        return self::getGroupSettings('widget.lastArticles', false);
    }

    public static function getWidgetPopularArticlesSettings()
    {
        return self::getGroupSettings('widget.popularArticles', false);
    }

    public static function getShortTextSettings()
    {
        return self::getGroupSettings('shortText', false);
    }

    public static function getMetaDescriptionSettings()
    {
        return self::getGroupSettings('metaDescription', false);
    }

    public static function getCronSettings()
    {
        return self::getGroupSettings('cron', false);
    }

    public static function getBrandingSettings()
    {
        return self::getGroupSettings('site', false);
    }

    public static function getDmcaPageSettings()
    {
        return self::getGroupSettings('page.dmca', false);
    }

    public static function getPrivacyPageSettings()
    {
        return self::getGroupSettings('page.privacy', false);
    }
}
