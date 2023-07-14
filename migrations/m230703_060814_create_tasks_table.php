<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tasks}}`.
 */
class m230703_060814_create_tasks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tasks}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(150)->notNull(),
            'task_description' => $this->text()->notNull(),
            'added_by' => $this->integer()->notNull(),
            'operator_id' => $this->integer()->notNull(),
            'status' => $this->tinyInteger(1)->notNull()->comment('open=3 | reopen=4 | done=5'),
            'project_id' => $this->integer()->notNull(),
            'added_date' => $this->datetime()->notNull(),
            'last_update' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci');

        $this->createIndex('idx-tasks-added_by', '{{%tasks}}', 'added_by');
        $this->createIndex('idx-tasks-operator_id', '{{%tasks}}', 'operator_id');
        $this->createIndex('idx-tasks-project_id', '{{%tasks}}', 'project_id');

        $this->addForeignKey('fk-tasks-added_by-users-id', '{{%tasks}}', 'added_by', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-tasks-operator_id-users-id', '{{%tasks}}', 'operator_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-tasks-project_id-projects-id', '{{%tasks}}', 'project_id', 'projects', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-tasks-project_id-projects-id', '{{%tasks}}');
        $this->dropForeignKey('fk-tasks-operator_id-users-id', '{{%tasks}}');
        $this->dropForeignKey('fk-tasks-added_by-users-id', '{{%tasks}}');

        $this->dropIndex('idx-tasks-project_id', '{{%tasks}}');
        $this->dropIndex('idx-tasks-operator_id', '{{%tasks}}');
        $this->dropIndex('idx-tasks-added_by', '{{%tasks}}');

        $this->dropTable('{{%tasks}}');
    }
}
