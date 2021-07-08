<?php

namespace common\models;

use Yii;
use yii\helpers\Inflector;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $short_text
 * @property string|null $slug
 * @property string|null $text
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property string|null $thumb
 * @property string|null $table_contents
 * @property int $views
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text', 'short_text', 'thumb', 'table_contents'], 'string'],
            [['title', 'slug', 'meta_title', 'meta_description'], 'string', 'max' => 255],
            [['views'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'slug' => 'Slug',
            'text' => 'Текст статьи',
            'short_text' => 'Короткое описание',
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'thumb' => 'Миниатюра',
            'table_contents' => 'Содержание',
            'views' => 'Просмотров'
        ];
    }

    public static function create($title, $meta_title, $text, $thumbUrl = '', $tableContents = '', $shortText = '', $metaDescription = '')
    {
        $article = new Article();
        $slug = Inflector::slug($title);
        if (Article::findOne(['slug' => $slug]) !== null) {
            return false;
        }

        $article->title = $title;
        $article->meta_title = $meta_title;
        $article->slug = $slug;
        $article->text = $text;
        $article->thumb = $thumbUrl;
        $article->table_contents = $tableContents;
        $article->short_text = $shortText;
        $article->meta_description = $metaDescription;

        return $article->save();
    }

    public static function getRelated($articleId, $limit = 10)
    {
        return self::find()->where(['<', 'id', $articleId])->orderBy('id DESC')->limit($limit)->asArray()->all();
    }
}
