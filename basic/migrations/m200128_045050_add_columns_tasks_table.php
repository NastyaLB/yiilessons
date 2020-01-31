<?php

use yii\db\Migration;

/**
 * Class m200128_045050_add_columns_tasks_table
 */
class m200128_045050_add_columns_tasks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn( 'taskdb', 'starttime', 'datetime NOT NULL');
        $this->addColumn( 'taskdb', 'modifytime', 'datetime NOT NULL');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn( 'taskdb', 'starttime');
        $this->dropColumn( 'taskdb', 'modifytime');
    }   
}
