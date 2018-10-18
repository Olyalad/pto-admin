<?php

use yii\db\Migration;

/**
 * Class m181006_055928_add_column_user_table
 */
class m181006_055928_add_column_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('lb_user', 'login', $this->string()->notNull());
        $this->addColumn('lb_user', 'size', $this->integer()->comment('Лимит'));
        $this->addColumn('lb_user', 'groups', $this->string()->comment('Группа'));
        $this->addColumn('lb_user', 's', $this->integer());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('lb_user', 's');
        $this->dropColumn('lb_user', 'groups');
        $this->dropColumn('lb_user', 'size');
        $this->dropColumn('lb_user', 'login');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181006_055928_add_column_user_table cannot be reverted.\n";

        return false;
    }
    */
}
