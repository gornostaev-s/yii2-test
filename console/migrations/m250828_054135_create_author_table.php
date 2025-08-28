<?php

declare(strict_types=1);

use yii\db\Migration;

/**
 * Handles the creation of table `{{%author}}`.
 */
class m250828_054135_create_author_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%author}}', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string(255)->notNull(),
            'middle_name' => $this->string(255)->notNull(),
            'last_name' => $this->string(255)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%author}}');
    }
}
