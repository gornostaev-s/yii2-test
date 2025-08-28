<?php

declare(strict_types=1);

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book}}`.
 */
class m250827_164452_create_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%book}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255),
            'description' => $this->text(),
            'isbn' => $this->string(255),
            'year' => $this->integer()->notNull(),
            'image_url' => $this->string(255),
        ]);

        $this->createIndex('idx-book_year', '{{%book}}', 'year');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%book}}');
    }
}
