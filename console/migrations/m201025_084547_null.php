<?php

use yii\db\Migration;

/**
 * Class m201025_084547_null
 */
class m201025_084547_null extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('user_info', 'name', $this->text()->null());
        $this->alterColumn('user_info', 'surname', $this->text()->null());
        $this->alterColumn('user_info', 'date_birth', $this->date()->null());
        $this->alterColumn('user_info', 'role_id', $this->integer()->defaultValue(1));
        $this->alterColumn('user_info', 'phone', $this->char(12)->null());
        $this->alterColumn('user_info', 'telegram', $this->text()->null());
        $this->alterColumn('user_info', 'skype', $this->text()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201025_084547_null cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201025_084547_null cannot be reverted.\n";

        return false;
    }
    */
}
