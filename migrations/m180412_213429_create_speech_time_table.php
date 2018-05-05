<?php

use yii\db\Migration;

/**
 * Handles the creation of table `speech_time`.
 */
class m180412_213429_create_speech_time_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('speech_time', [
            'speech_id' => $this->integer()->notNull(),
            'speech_start' => $this->integer()->notNull(),
            'voting_start' => $this->integer()->null(),
            'voting_end' => $this->integer()->null(),
            'PRIMARY KEY (speech_id)'
        ]);

        $this->createIndex(
            'idx-speech_id-speech_time',
            'speech_time',
            'speech_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('speech_time');

        $this->dropIndex(
            'idx-speech_id-speech_time',
            'speech_id'
        );
    }
}
