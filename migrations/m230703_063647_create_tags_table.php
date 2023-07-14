<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tags}}`.
 */
class m230703_063647_create_tags_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tags}}', [
            'id' => $this->primaryKey(),
            'tag' => $this->string(150)->notNull(),
            'added_date' => $this->datetime()->notNull(),
            'last_update' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP()'),
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tags}}');
    }
}
