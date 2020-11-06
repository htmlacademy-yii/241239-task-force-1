<?php

use yii\db\Migration;

/**
 * Class m201106_080425_attach_link
 */
class m201106_080425_attach_link extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('attachment_ibfk_1', 'attachment');
        $this->dropColumn('attachment', 'task_id');
        $this->addColumn('attachment', 'attach_uuid', 'char(255)');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201106_080425_attach_link cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201106_080425_attach_link cannot be reverted.\n";

        return false;
    }
    */
}
