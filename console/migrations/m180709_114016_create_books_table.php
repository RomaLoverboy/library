<?php

use yii\db\Migration;

/**
 * Handles the creation of table `books`.
 */
class m180709_114016_create_books_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('books', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'author' => $this->string(255)->notNull(),
            'genre' => $this->string(255),
            'year_publishing' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('books');
    }
}
