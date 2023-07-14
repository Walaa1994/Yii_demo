<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%task_status}}`.
 */
class m230703_061610_create_task_status_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%task_status}}', [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer()->notNull(),
            'status' => $this->tinyInteger(1)->notNull(),
            'added_date' => $this->datetime()->notNull(),
            'added_by' => $this->integer()->notNull(),
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci');

        $this->createIndex('idx-task_status-task_id', '{{%task_status}}', 'task_id');

        $this->addForeignKey('fk-task_status-task_id-tasks-id', '{{%task_status}}', 'task_id', 'tasks', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-task_status-task_id-tasks-id', '{{%task_status}}');
        $this->dropIndex('idx-task_status-task_id', '{{%task_status}}');
        $this->dropTable('{{%task_status}}');
    }
}
