<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%author_user}}`.
 */
class m250829_130709_create_author_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%author_user}}', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
        ]);

        $this->createIndex('idx-author_user', '{{%author_user}}', ['author_id', 'user_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%author_user}}');
    }
}
