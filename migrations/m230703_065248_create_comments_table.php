<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comments}}`.
 */
class m230703_065248_create_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comments}}', [
            'id' => $this->primaryKey(),
            'comment' => $this->string(500)->notNull(),
            'added_by' => $this->integer(11)->notNull(),
            'task_id' => $this->integer(11)->notNull(),
            'last_update' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci');

        $this->createIndex('idx-comments-task_id', '{{%comments}}', 'task_id');
        $this->createIndex('idx-comments-added_by', '{{%comments}}', 'added_by');

        $this->addForeignKey('fk-comments-task_id', '{{%comments}}', 'task_id', 'tasks', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-comments-added_by', '{{%comments}}', 'added_by', 'users', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-comments-task_id', '{{%comments}}');
        $this->dropForeignKey('fk-comments-added_by', '{{%comments}}');

        $this->dropIndex('idx-comments-task_id', '{{%comments}}');
        $this->dropIndex('idx-comments-added_by', '{{%comments}}');

        $this->dropTable('{{%comments}}');
    }
}
