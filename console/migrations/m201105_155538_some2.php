<?php

use yii\db\Migration;

/**
 * Class m201105_155538_some2
 */
class m201105_155538_some2 extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('task', 'att_id', $this->char()->unique());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201105_155538_some2 cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201105_155538_some2 cannot be reverted.\n";

        return false;
    }
    */
}
