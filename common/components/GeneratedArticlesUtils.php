<?php

namespace common\components;

use common\models\Setting;
use phpQuery;
use yii\helpers\StringHelper;

class GeneratedArticlesUtils
{
    public static function getArticleWithTableOfContents($article)
    {
        $index = 1;
        $tableContentsParts = [];
        $articleHtml = phpQuery::newDocument($article);
        $h2Headers = $articleHtml->find('h2');
        array_push($tableContentsParts, '<ul>');
        foreach ($h2Headers as $h2Header) {
            $pqH2 = pq($h2Header);
            $anchor = 'header-' . $index;
            $pqH2->attr('id', $anchor);
            $text = $pqH2->text();
            $text = htmlentities($text);
            $text = str_replace("&nbsp;",' ',$text);
            $pqH2->text($text);
            if (!empty($pqH2->text()) && $pqH2->text() !== ' ' && $pqH2->text() !== '') {
                array_push($tableContentsParts, '<li><a href="#' . $anchor . '">' . $pqH2->text() . '</a></li>');
            }
            $index++;
        }
        array_push($tableContentsParts, '</ul>');

        return [
            'tableContents' => implode($tableContentsParts, PHP_EOL),
            'content' => $articleHtml->html()
        ];
    }

    public static function getThumb($article)
    {
        $articleHtml = phpQuery::newDocument($article);
        $src = $articleHtml->find('img')->eq(0)->attr('src');
        $thumbUrl = ImageUploader::saveImage($src);

        return $thumbUrl ? $thumbUrl : '';
    }

    public static function generateDescription($article)
    {
        $metaDescriptionSettings = Setting::getMetaDescriptionSettings();
        $text = StringHelper::truncate(strip_tags($article), $metaDescriptionSettings['length'], '', 'UTF-8', true);
        return self::prettyString($text);
    }

    public static function generateShortText($article)
    {
        $shortTextSettings = Setting::getShortTextSettings();
        $text = trim(StringHelper::truncateWords(strip_tags($article), $shortTextSettings['length'], ''));
        return self::prettyString($text);
    }


    public static function prettyString($string)
    {
        $string = preg_replace('/\s/ui', ' ', $string);
        return trim(preg_replace('/[^a-zA-Zа-яА-Я0-9.,-?!:; ]/ui', '', $string));
    }
}