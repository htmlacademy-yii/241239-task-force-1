<?php

use yii\db\Migration;

/**
 * Class m201023_162614_new
 */
class m201023_162614_new extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'name', $this->string()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201023_162614_new cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201023_162614_new cannot be reverted.\n";

        return false;
    }
    */
}
