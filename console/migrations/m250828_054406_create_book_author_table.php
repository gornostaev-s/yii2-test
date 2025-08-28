<?php

declare(strict_types=1);

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book_author}}`.
 */
class m250828_054406_create_book_author_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%book_author}}', [
            'id' => $this->primaryKey(),
            'book_id' => $this->integer()->notNull(),
            'author_id' => $this->integer()->notNull(),
        ]);

        $this->createIndex('idx-book_author', '{{%book_author}}', ['book_id', 'author_id']);

        $this->addForeignKey(
            'fk-book_author_author_id',
            '{{%book_author}}',
            'author_id',
            'author',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-book_author_book_id',
            '{{%book_author}}',
            'book_id',
            'book',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%book_author}}');
    }
}
