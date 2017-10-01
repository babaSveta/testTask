<?php

use yii\db\Migration;

class m170924_102202_create_type_user extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{type_user}}', [
            'id' => $this->string(255)->unique()
        ]);

        $this->insert('{{type_user}}', ['id' => 'admin']);
        $this->insert('{{type_user}}', ['id' => 'user']);
    }

    public function safeDown()
    {
        $this->dropTable('{{type_user}}');
    }
}
