<?php

use yii\db\Migration;

/**
 * Class m210704_213537_add_access_token_to_user_table
 */
class m210704_213537_add_access_token_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'access_token', $this->string()->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'access_token');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210704_213537_add_access_token_to_user_table cannot be reverted.\n";

        return false;
    }
    */
}
