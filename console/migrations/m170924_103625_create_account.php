<?php

use yii\db\Migration;

class m170924_103625_create_account extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%account}}', [
            'id' => $this->primaryKey(),
            'id_user' => $this->integer()->notNull(),
            'amount' => $this->decimal(24,2)->notNull()->defaultValue(0),
        ]);

        $this->addForeignKey('FK_account_id_user__user_id', '{{account}}', 'id_user', '{{user}}', 'id');
    }

    public function safeDown()
    {
        $this->dropTable('{{%account}}');
        $this->dropForeignKey('FK_account_id_user__user_id', '{{account}}');
    }
}
