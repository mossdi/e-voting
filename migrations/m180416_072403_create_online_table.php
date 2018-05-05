<?php

use yii\db\Migration;

/**
 * Handles the creation of table `online`.
 */
class m180416_072403_create_online_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('online', [
            'user_id' => $this->integer()->notNull(),
            'last_activity' => $this->integer()->notNull(),
            'ip' => $this->string()->notNull(),
            'PRIMARY KEY (user_id)'
        ]);

        $this->createIndex(
            'idx-user_id-online',
            'online',
            'user_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('online');

        $this->dropIndex(
            'idx-user_id-online',
            'online'
        );
    }
}
