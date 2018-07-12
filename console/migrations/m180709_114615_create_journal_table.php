<?php

use yii\db\Migration;

/**
 * Handles the creation of table `journal`.
 * Has foreign keys to the tables:
 *
 * - `users`
 * - `books`
 */
class m180709_114615_create_journal_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('journal', [
            'id' => $this->primaryKey(),
            'id_user' => $this->integer()->notNull(),
            'id_book' => $this->integer()->notNull(),
            'dateBegin' => $this->integer()->notNull(),
            'dateEnd' => $this->integer()->notNull(),
        ]);

        // creates index for column `id_user`
        $this->createIndex(
            'idx-journal-id_user',
            'journal',
            'id_user'
        );

        // add foreign key for table `users`
        $this->addForeignKey(
            'fk-journal-id_user',
            'journal',
            'id_user',
            'users',
            'id',
            'CASCADE'
        );

        // creates index for column `id_book`
        $this->createIndex(
            'idx-journal-id_book',
            'journal',
            'id_book'
        );

        // add foreign key for table `books`
        $this->addForeignKey(
            'fk-journal-id_book',
            'journal',
            'id_book',
            'books',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `users`
        $this->dropForeignKey(
            'fk-journal-id_user',
            'journal'
        );

        // drops index for column `id_user`
        $this->dropIndex(
            'idx-journal-id_user',
            'journal'
        );

        // drops foreign key for table `books`
        $this->dropForeignKey(
            'fk-journal-id_book',
            'journal'
        );

        // drops index for column `id_book`
        $this->dropIndex(
            'idx-journal-id_book',
            'journal'
        );

        $this->dropTable('journal');
    }
}
