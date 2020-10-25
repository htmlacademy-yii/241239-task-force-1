<?php

use yii\db\Migration;

/**
 * Class m201024_163838_drop
 */
class m201024_163838_drop extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('user', 'name');
        $this->dropForeignKey('user_ibfk_1', 'user');
        $this->dropColumn('user', 'city_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201024_163838_drop cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201024_163838_drop cannot be reverted.\n";

        return false;
    }
    */
}
