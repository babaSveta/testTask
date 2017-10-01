<?php

use yii\db\Migration;
use common\models\user\TypeUser;

class m170924_102202_create_type_user extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{type_user}}', [
            'id' => $this->string(255)->unique()
        ]);

        $this->insert('{{type_user}}', ['id' => TypeUser::CONST_ADMIN]);
        $this->insert('{{type_user}}', ['id' => TypeUser::CONST_USER]);
    }

    public function safeDown()
    {
        $this->dropTable('{{type_user}}');
    }
}
