<?php

use yii\db\Migration;

/**
 * Handles the creation of table `rating`.
 */
class m180411_151329_create_rating_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('rating', [
            'speech_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'efficiency' => $this->integer()->notNull(),
            'newness' => $this->integer()->notNull(),
            'originality' => $this->integer()->notNull(),
            'reliability' => $this->integer()->notNull(),
            'acceptance' => $this->integer()->notNull(),
            'PRIMARY KEY (speech_id, user_id)'
        ]);

        $this->createIndex(
            'idx-speech_id-user_id-rating',
            'rating',
            'speech_id, user_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('rating');

        $this->dropIndex(
            'idx-speech_id-user_id-rating',
            'rating'
        );
    }
}
