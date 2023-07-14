<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comment_history}}`.
 */
class m230703_071329_create_comment_history_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comment_history}}', [
            'id' => $this->primaryKey(),
            'comment_id' => $this->integer()->notNull(),
            'comment' => $this->string(500)->notNull(),
            'added_date' => $this->datetime()->notNull(),
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci');

        $this->createIndex(
            'idx-comment_history-comment_id',
            'comment_history',
            'comment_id'
        );

        $this->addForeignKey(
            'fk-comment_history-comment_id',
            'comment_history',
            'comment_id',
            'comments',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-comment_history-comment_id',
            '{{%comment_history}}'
        );
        $this->dropIndex(
            'idx-comment_history-comment_id',
            '{{%comment_history}}'
        );
        $this->dropTable(
            '{{%comment_history}}'
        );
    }
}
