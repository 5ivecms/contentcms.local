<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%setting}}`.
 */
class m210612_105841_create_setting_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%setting}}', [
            'id' => $this->primaryKey(),
            'option' => $this->string(255),
            'value' => $this->text(),
            'default' => $this->text(),
            'label' => $this->text(),
        ], $tableOptions);

        $this->createIndex(
            'idx-setting-option',
            'setting',
            'option',
            true
        );

        // Настройки кеширования
        $this->insert('{{%setting}}', [
            'option' => 'cache.duration',
            'value' => 120,
            'default' => 120,
            'label' => 'Длительность кеширования (секунды)'
        ]);

        // Настройки темы
        $this->insert('{{%setting}}', [
            'option' => 'themes.theme',
            'value' => 'basic',
            'default' => 'basic',
            'label' => 'Тема'
        ]);

        // Короткое описание
        $this->insert('{{%setting}}', [
            'option' => 'shortText.length',
            'value' => 30,
            'default' => 30,
            'label' => 'Количество слов'
        ]);

        // Настройки генерации description
        $this->insert('{{%setting}}', [
            'option' => 'metaDescription.length',
            'value' => 160,
            'default' => 160,
            'label' => 'Количество символов'
        ]);

        // Настройки api
        $this->insert('{{%setting}}', [
            'option' => 'contentApi.host',
            'value' => '',
            'default' => '',
            'label' => 'Хост'
        ]);

        $this->insert('{{%setting}}', [
            'option' => 'contentApi.token',
            'value' => '',
            'default' => '',
            'label' => 'Токен'
        ]);

        // Настройка парсера
        $this->insert('{{%setting}}', [
            'option' => 'articleParser.mode',
            'value' => 1,
            'default' => 1,
            'label' => 'Режим работы'
        ]);

        $this->insert('{{%setting}}', [
            'option' => 'articleParser.mode1.articlesLimit',
            'value' => 5,
            'default' => 5,
            'label' => 'Количество статей'
        ]);

        $this->insert('{{%setting}}', [
            'option' => 'articleParser.mode1.startPage',
            'value' => 1,
            'default' => 1,
            'label' => 'Стартовая страница'
        ]);

        $this->insert('{{%setting}}', [
            'option' => 'articleParser.mode1.pagesLimit',
            'value' => 1,
            'default' => 1,
            'label' => 'Количество страниц'
        ]);

        $this->insert('{{%setting}}', [
            'option' => 'articleParser.mode2.articlesLimit',
            'value' => 5,
            'default' => 5,
            'label' => 'Количество статей'
        ]);

        $this->insert('{{%setting}}', [
            'option' => 'articleParser.mode2.startPage',
            'value' => 1,
            'default' => 1,
            'label' => 'Стартовая страница'
        ]);

        $this->insert('{{%setting}}', [
            'option' => 'articleParser.mode2.pagesLimit',
            'value' => 1,
            'default' => 1,
            'label' => 'Количество страниц'
        ]);

        $this->insert('{{%setting}}', [
            'option' => 'articleParser.mode3.articlesLimit',
            'value' => 5,
            'default' => 5,
            'label' => 'Количество статей'
        ]);

        $this->insert('{{%setting}}', [
            'option' => 'articleParser.mode3.chunksLimit',
            'value' => 10,
            'default' => 10,
            'label' => 'Количество частей'
        ]);

        $this->insert('{{%setting}}', [
            'option' => 'articleParser.mode3.startPage',
            'value' => 1,
            'default' => 1,
            'label' => 'Стартовая страница'
        ]);

        $this->insert('{{%setting}}', [
            'option' => 'articleParser.mode3.pagesLimit',
            'value' => 1,
            'default' => 1,
            'label' => 'Количество страниц'
        ]);

        $this->insert('{{%setting}}', [
            'option' => 'articleParser.mode4.articlesLimit',
            'value' => 5,
            'default' => 5,
            'label' => 'Количество статей'
        ]);

        $this->insert('{{%setting}}', [
            'option' => 'articleParser.mode4.startPage',
            'value' => 1,
            'default' => 1,
            'label' => 'Стартовая страница'
        ]);

        $this->insert('{{%setting}}', [
            'option' => 'articleParser.mode4.pagesLimit',
            'value' => 1,
            'default' => 1,
            'label' => 'Количество страниц'
        ]);

        $this->insert('{{%setting}}', [
            'option' => 'articleParser.mode5.articlesLimit',
            'value' => 5,
            'default' => 5,
            'label' => 'Количество статей'
        ]);

        $this->insert('{{%setting}}', [
            'option' => 'articleParser.mode5.startPage',
            'value' => 1,
            'default' => 1,
            'label' => 'Стартовая страница'
        ]);

        $this->insert('{{%setting}}', [
            'option' => 'articleParser.mode5.pagesLimit',
            'value' => 1,
            'default' => 1,
            'label' => 'Количество страниц'
        ]);

        // Настройки главной страницы
        $this->insert('{{%setting}}', [
            'option' => 'homePage.h1',
            'value' => 'Самые крутые статьи',
            'default' => 'Самые крутые статьи',
            'label' => 'h1 заголовок'
        ]);

        $this->insert('{{%setting}}', [
            'option' => 'homePage.metaTitle',
            'value' => 'Самые крутые статьи',
            'default' => 'Самые крутые статьи',
            'label' => 'Meta title'
        ]);

        $this->insert('{{%setting}}', [
            'option' => 'homePage.metaDescription',
            'value' => 'Самые крутые статьи',
            'default' => 'Самые крутые статьи',
            'label' => 'Meta description'
        ]);

        $this->insert('{{%setting}}', [
            'option' => 'homePage.seoText1.text',
            'value' => '',
            'default' => '',
            'label' => 'SEO текст 1'
        ]);

        $this->insert('{{%setting}}', [
            'option' => 'homePage.seoText1.show',
            'value' => 0,
            'default' => 0,
            'label' => 'Выводить SEO текст 1'
        ]);

        $this->insert('{{%setting}}', [
            'option' => 'homePage.seoText2.text',
            'value' => '',
            'default' => '',
            'label' => 'SEO текст 2'
        ]);

        $this->insert('{{%setting}}', [
            'option' => 'homePage.seoText2.show',
            'value' => 0,
            'default' => 0,
            'label' => 'Выводить SEO текст 2'
        ]);

        $this->insert('{{%setting}}', [
            'option' => 'homePage.articles.limit',
            'value' => 8,
            'default' => 8,
            'label' => 'Количество статей'
        ]);

        // Каталог статей
        $this->insert('{{%setting}}', [
            'option' => 'articlesCatalog.h1',
            'value' => 'Каталог статей',
            'default' => 'Каталог статей',
            'label' => 'h1 заголовок'
        ]);

        $this->insert('{{%setting}}', [
            'option' => 'articlesCatalog.metaTitle',
            'value' => 'Каталог статей',
            'default' => 'Каталог статей',
            'label' => 'Meta title'
        ]);

        $this->insert('{{%setting}}', [
            'option' => 'articlesCatalog.metaDescription',
            'value' => 'Каталог статей',
            'default' => 'Каталог статей',
            'label' => 'Meta description'
        ]);

        $this->insert('{{%setting}}', [
            'option' => 'articlesCatalog.seoText1.text',
            'value' => '',
            'default' => '',
            'label' => 'SEO текст 1'
        ]);

        $this->insert('{{%setting}}', [
            'option' => 'articlesCatalog.seoText1.show',
            'value' => 0,
            'default' => 0,
            'label' => 'Выводить SEO текст 1'
        ]);

        $this->insert('{{%setting}}', [
            'option' => 'articlesCatalog.seoText2.text',
            'value' => '',
            'default' => '',
            'label' => 'SEO текст 2'
        ]);

        $this->insert('{{%setting}}', [
            'option' => 'articlesCatalog.seoText2.show',
            'value' => 0,
            'default' => 0,
            'label' => 'Выводить SEO текст 2'
        ]);

        $this->insert('{{%setting}}', [
            'option' => 'articlesCatalog.articles.limit',
            'value' => 8,
            'default' => 8,
            'label' => 'Количество статей'
        ]);

        // Страница статьи
        $this->insert('{{%setting}}', [
            'option' => 'article.h1',
            'value' => '{title}',
            'default' => '{title}',
            'label' => 'h1 заголовок'
        ]);

        $this->insert('{{%setting}}', [
            'option' => 'article.metaTitle',
            'value' => '{title}',
            'default' => '{title}',
            'label' => 'Meta title'
        ]);

        $this->insert('{{%setting}}', [
            'option' => 'article.related.limit',
            'value' => 8,
            'default' => 8,
            'label' => 'Количество похожих'
        ]);

        $this->insert('{{%setting}}', [
            'option' => 'article.related.title',
            'value' => 'Похожие',
            'default' => 'Похожие',
            'label' => 'Заголовок'
        ]);

        $this->insert('{{%setting}}', [
            'option' => 'article.thumb.show',
            'value' => 1,
            'default' => 1,
            'label' => 'Выводить превью'
        ]);

        $this->insert('{{%setting}}', [
            'option' => 'article.tableContents.show',
            'value' => 1,
            'default' => 1,
            'label' => 'Выводить оглавление'
        ]);

        // Виджет последние статьи
        $this->insert('{{%setting}}', [
            'option' => 'widget.lastArticles.show',
            'value' => 1,
            'default' => 1,
            'label' => 'Выводить виджет'
        ]);

        $this->insert('{{%setting}}', [
            'option' => 'widget.lastArticles.limit',
            'value' => 5,
            'default' => 5,
            'label' => 'Количество'
        ]);

        $this->insert('{{%setting}}', [
            'option' => 'widget.lastArticles.title',
            'value' => 'Последние статьи',
            'default' => 'Последние статьи',
            'label' => 'Заголовок'
        ]);

        // Виджет популярные статьи
        $this->insert('{{%setting}}', [
            'option' => 'widget.popularArticles.show',
            'value' => 1,
            'default' => 1,
            'label' => 'Выводить виджет'
        ]);

        $this->insert('{{%setting}}', [
            'option' => 'widget.popularArticles.limit',
            'value' => 5,
            'default' => 5,
            'label' => 'Количество'
        ]);

        $this->insert('{{%setting}}', [
            'option' => 'widget.popularArticles.title',
            'value' => 'Популярные статьи',
            'default' => 'Популярные статьи',
            'label' => 'Заголовок'
        ]);

        // Настройки cron
        $this->insert('{{%setting}}', [
            'option' => 'cron.keywords.enabled',
            'value' => 1,
            'default' => 1,
            'label' => 'Включить'
        ]);

        $this->insert('{{%setting}}', [
            'option' => 'cron.keywords.limit',
            'value' => 1,
            'default' => 1,
            'label' => 'Количество ключевых слов'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%setting}}');
    }
}
