<?php

use yii\db\Migration;

class m170924_112738_insert_account extends Migration
{

    public function safeUp()
    {
        $this->insert('{{account}}', [
            'id_user' => $this->getAdminId(),
            'amount' => 5000000,
        ]);
    }

    public function safeDown()
    {
        $this->delete('{{account}}', ['id_user' => $this::getAdminId()]);
    }

    public function getAdminId()
    {
        $adminId = (new \yii\db\Query)->select(['id'])->from('{{%user}}')->where(['email' => 'admin@mail.ru'])->limit(1)->scalar();

        return $adminId;
    }
}
