<?php

use yii\db\Migration;
use \common\models\user\TypeUser;

class m170924_102648_change_user extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{user}}', 'id_type_user', $this->string(255)->defaultValue(TypeUser::CONST_USER));
    }

    public function safeDown()
    {
        $this->dropColumn('{{user}}', 'id_type_user');
    }
}
