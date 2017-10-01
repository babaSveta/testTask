<?php

use yii\db\Migration;

class m170924_105140_create_operation extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{operation}}', [
            'id' => $this->primaryKey(),
            'accounted_at' => 'timestamp with time zone NOT NULL DEFAULT NOW()',
            'id_user_created' => $this->integer()->notNull(),
            'id_account_from' => $this->integer()->notNull(),
            'id_account_to' => $this->integer()->notNull(),
            'amount' => $this->decimal(24, 2)->notNull(),
            'amount_from_before' => $this->decimal(24, 2)->notNull(),
            'amount_from_after' => $this->decimal(24, 2)->notNull(),
            'amount_to_before' => $this->decimal(24, 2)->notNull(),
            'amount_to_after' => $this->decimal(24, 2)->notNull(),
        ]);

        $this->addForeignKey('FK_operation_id_user_created__user_id',
            '{{operation}}', 'id_user_created',
            '{{user}}', 'id'
        );

        $this->addForeignKey('FK_operation_id_account_from__account_id',
            '{{operation}}', 'id_account_from',
            '{{account}}', 'id'
        );

        $this->addForeignKey('FK_operation_id_account_to__account_id',
            '{{operation}}', 'id_account_to',
            '{{account}}', 'id'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{operation}}');
    }
}
