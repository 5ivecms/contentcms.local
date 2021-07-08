<?php

namespace common\components;

use Yii;

class ImageUploader
{
    const FOLDER = 'images';

    public static function saveImage($url)
    {
        try {
            $content = file_get_contents($url);
        } catch (\Exception $e) {
            return false;
        }

        $imageName = md5($url) . '.jpg';

        $paths = [self::FOLDER];
        array_push($paths, date('Y-m-d'));

        $path = implode('/', $paths);
        $absPath = Yii::getAlias('@storage/' . $path);
        $relPath = Yii::getAlias('@storageFolder/' . $path);
        $fullRelPath = Yii::getAlias($relPath . '/' . $imageName);
        $fullAbsPath = Yii::getAlias($absPath . '/' . $imageName);

        if (!file_exists($absPath)) {
            mkdir($absPath, 0755, true);
        }

        $result = file_put_contents($fullAbsPath, $content);
        if (!$result) {
            return false;
        }

        return $fullRelPath;
    }

    public static function deleteImage($src)
    {
        if (empty($src)) {
            return false;
        }

        $path = str_replace(Yii::getAlias('@storageFolder'), '', Yii::getAlias('@storage'));
        $fullPath = $path . '/' . $src;
        if (file_exists($fullPath)) {
            return unlink($fullPath);
        }

        return false;
    }
}