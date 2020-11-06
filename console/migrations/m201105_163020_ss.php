<?php

use yii\db\Migration;

/**
 * Class m201105_163020_ss
 */
class m201105_163020_ss extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('task', 'att_id', $this->char(255)->unique());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201105_163020_ss cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201105_163020_ss cannot be reverted.\n";

        return false;
    }
    */
}
