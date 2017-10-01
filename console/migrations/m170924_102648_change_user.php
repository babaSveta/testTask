<?php

use yii\db\Migration;

class m170924_102648_change_user extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{user}}', 'id_type_user', $this->string(255)->defaultValue('user'));
    }

    public function safeDown()
    {
        $this->dropColumn('{{user}}', 'id_type_user');
    }
}
