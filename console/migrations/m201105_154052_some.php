<?php

use yii\db\Migration;

/**
 * Class m201105_154052_some
 */
class m201105_154052_some extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('task', 'att_id', $this->integer()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201105_154052_some cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201105_154052_some cannot be reverted.\n";

        return false;
    }
    */
}
