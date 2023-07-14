<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%attachments}}`.
 */
class m230703_065001_create_attachments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%attachments}}', [
            'id' => $this->primaryKey(),
            'file_name' => $this->string(150)->notNull(),
            'system_name' => $this->integer(60)->notNull(),
            'ext' => $this->char(3)->notNull(),
            'added_date' => $this->datetime()->notNull(),
            'file_size' => $this->integer(4)->notNull(),
            'object_id' => $this->integer(11)->notNull(),
            'object_type' => $this->tinyInteger(1)->notNull()->comment('task=4 | comment=3'),
            'last_update' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%attachments}}');
    }
}
