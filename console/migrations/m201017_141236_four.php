<?php

use yii\db\Migration;

/**
 * Class m201017_141236_four
 */
class m201017_141236_four extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('attachment', 'name', $this->string()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201017_141236_four cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201017_141236_four cannot be reverted.\n";

        return false;
    }
    */
}
