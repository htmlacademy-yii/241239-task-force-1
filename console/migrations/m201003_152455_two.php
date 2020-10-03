<?php

use yii\db\Migration;

/**
 * Class m201003_152455_two
 */
class m201003_152455_two extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user_info', 'bio', $this->text()->defaultValue('Some bio text'));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201003_152455_two cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201003_152455_two cannot be reverted.\n";

        return false;
    }
    */
}
