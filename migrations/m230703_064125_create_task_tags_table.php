<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%task_tags}}`.
 */
class m230703_064125_create_task_tags_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%task_tags}}', [
            'id' => $this->primaryKey(),
            'tag_id' => $this->integer(11)->notNull(),
            'task_id' => $this->integer(11)->notNull(),
            'added_date' => $this->datetime()->notNull(),
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci');

        $this->createIndex('idx-task_tags-tag_id', '{{%task_tags}}', 'tag_id');
        $this->createIndex('idx-task_tags-task_id', '{{%task_tags}}', 'task_id');

        $this->addForeignKey('fk-task_tags-tag_id', '{{%task_tags}}', 'tag_id', 'tags', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-task_tags-task_id', '{{%task_tags}}', 'task_id', 'tasks', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-task_tags-tag_id', '{{%task_tags}}');
        $this->dropForeignKey('fk-task_tags-task_id', '{{%task_tags}}');

        $this->dropIndex('idx-task_tags-tag_id', '{{%task_tags}}');
        $this->dropIndex('idx-task_tags-task_id', '{{%task_tags}}');

        $this->dropTable('{{%task_tags}}');
    }
}
