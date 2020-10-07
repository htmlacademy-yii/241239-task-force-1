<?php

use yii\db\Migration;

/**
 * Class m201002_170538_one
 */
class m201002_170538_one extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('status', [
        'id' => $this->primaryKey(),
        'slug' => $this->char(255)->notNull()->unique(),
        'text' => $this->char(255)->notNull()->unique()
    ], '');

        $this->batchInsert('status', ['slug', 'text'], [
            ['new', 'Новое'],
            ['cancel', 'Отменено'],
            ['work', 'В работе'],
            ['done', 'Выполнено'],
            ['fail', 'Провалено']
        ]);

        $this->renameColumn('task', 'status', 'status_id');
        $this->execute('UPDATE task SET status_id = (FLOOR(1 + RAND() * 3))');
        $this->alterColumn('task', 'status_id', $this->integer());

        $this->addForeignKey(
            'fk_status_id',
            'task',
            'status_id',
            'status',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201002_170538_one cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201002_170538_one cannot be reverted.\n";

        return false;
    }
    */
}
