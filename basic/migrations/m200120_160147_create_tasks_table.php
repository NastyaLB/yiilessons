<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tasks}}`.
 */
class m200120_160147_create_tasks_table extends Migration {
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('taskDB', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
            'creator_id' => $this->integer(),
            'responsible_id' => $this->integer(),
            'deadline' => $this->dateTime(),
            'status_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('taskDB');
    }
}
