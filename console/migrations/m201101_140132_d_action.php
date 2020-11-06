<?php

use yii\db\Migration;

/**
 * Class m201101_140132_d_action
 */
class m201101_140132_d_action extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('task', 'action');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201101_140132_d_action cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201101_140132_d_action cannot be reverted.\n";

        return false;
    }
    */
}
