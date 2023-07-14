<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m230702_151742_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'fisrt_name' => $this->string(50)->notNull(),
            'last_name' => $this->string(50)->notNull(),
            'username' => $this->string(35)->notNull(),
            'email' => $this->string(50)->notNull(),
            'status' => $this->tinyInteger(1)->notNull()->comment('2=active | 3=inactive'),
            'password' => $this->string(60)->notNull(),
            'photo' => $this->string(50)->notNull(),
            'permission' => $this->tinyInteger(1)->notNull()->comment('admin=2 | user=3'),
            'added_date' => $this->datetime()->notNull(),
            'gender' => $this->tinyInteger(1)->notNull()->comment('2=male | 3=female'),
            'birthday' => $this->string(10)->notNull(),
            'last_update' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
