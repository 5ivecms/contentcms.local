<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%article}}`.
 */
class m210622_212556_create_article_table extends Migration
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

        $this->createTable('{{%article}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255),
            'slug' => $this->string(255),
            'thumb' => $this->string(255)->defaultValue(null),
            'short_text' => $this->text()->defaultValue(NULL),
            'text' => $this->getDb()->getSchema()->createColumnSchemaBuilder('longtext'),
            'table_contents' => $this->getDb()->getSchema()->createColumnSchemaBuilder('longtext'),
            'meta_title' => $this->string(255),
            'meta_description' => $this->string(255),
            'views' => $this->integer()->defaultValue(0),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ], $tableOptions);

        $this->createIndex(
            'idx-article-slug',
            'article',
            'slug',
            true
        );

        $this->createIndex(
            'idx-article-title',
            'article',
            'title'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%article}}');
    }
}
