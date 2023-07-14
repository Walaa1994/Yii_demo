<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%projects}}`.
 */
class m230702_160655_create_projects_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%projects}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(150)->notNull(),
            'projetc_descrption' => $this->string(255)->notNull(),
            'status' => $this->tinyInteger(1)->notNull()->comment('2=active | 3=inactive'),
            'added_by' => $this->integer()->notNull(),
            'added_date' => $this->datetime()->notNull(),
        ],'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%projects}}');
    }
}
