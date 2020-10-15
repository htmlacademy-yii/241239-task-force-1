<?php

use yii\db\Migration;

/**
 * Class m201015_133031_three
 */
class m201015_133031_three extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('task', 'executor_id', $this->integer()->null());
        $this->addColumn('user_info', 'last_activity', $this->timestamp());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201015_133031_three cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201015_133031_three cannot be reverted.\n";

        return false;
    }
    */
}
