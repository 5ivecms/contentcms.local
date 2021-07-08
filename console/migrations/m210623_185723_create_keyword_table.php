<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%keyword}}`.
 */
class m210623_185723_create_keyword_table extends Migration
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

        $this->createTable('{{%keyword}}', [
            'id' => $this->primaryKey(),
            'keyword' => $this->string(255),
            'is_completed' => $this->integer(2)->defaultValue(0),
            'is_failed' => $this->integer(2)->defaultValue(0),
        ], $tableOptions);

        $this->createIndex(
            'idx-keyword-keyword',
            'keyword',
            'keyword',
            true
        );

        $this->createIndex(
            'idx-keyword-is_completed',
            'keyword',
            'is_completed'
        );

        $this->createIndex(
            'idx-keyword-is_failed',
            'keyword',
            'is_failed'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%keyword}}');
    }
}
