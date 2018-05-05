<?php

use yii\db\Migration;

/**
 * Handles the creation of table `speech_logo`.
 */
class m180419_075347_create_speech_logo_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('speech_logo', [
            'speech_id' => $this->integer()->notNull(),
            'image' => $this->string()->notNull(),
            'PRIMARY KEY (speech_id)'
        ]);

        $this->createIndex(
            'idx-speech_id-speech_logo',
            'speech_logo',
            'speech_id'
        );

        $this->addForeignKey(
            'fk-speech_id-speech_logo',
            'speech_logo',
            'speech_id',
            'speech',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('speech_logo');

        $this->dropIndex(
            'idx-speech_id-speech_logo',
            'speech_logo'
        );
    }
}
