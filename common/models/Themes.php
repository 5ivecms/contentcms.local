<?php

namespace common\models;

use Yii;

class Themes
{
    public static function current()
    {
        $theme = Yii::$app->cache->get('themes.theme');
        if (!$theme) {
            $theme = Setting::find()->where(['option' => 'themes.theme'])->one();
            Yii::$app->cache->set('themes.theme', $theme, 0);
        }

        return $theme['value'];
    }

    public static function themesList()
    {
        $dirs = self::customScan(Yii::getAlias('@frontend') . '/themes');
        $themes = [];
        foreach ($dirs as $dir) {
            $themes[$dir] = $dir;
        }

        return $themes;
    }

    private static function customScan($dir, $sort = 0)
    {
        $list = scandir($dir, $sort);
        if (!$list) {
            return false;
        }

        if ($sort == 0) {
            unset($list[0], $list[1]);
        } else {
            unset($list[count($list) - 1], $list[count($list) - 1]);
        }

        return $list;
    }
}