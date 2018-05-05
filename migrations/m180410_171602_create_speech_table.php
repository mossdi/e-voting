<?php

use yii\db\Migration;

/**
 * Handles the creation of table `speech`.
 */
class m180410_171602_create_speech_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        } else {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci';
        }

        $this->createTable('speech', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'collective' => $this->string()->notNull(),
            'member' => $this->string()->notNull(),
            'now' => $this->smallInteger()->notNull()->defaultValue(0),
            'voting' => $this->smallInteger()->notNull()->defaultValue(0),
            'sort_order' => $this->integer()->notNull()->defaultValue(1),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('speech');
    }
}
