<?php

use yii\db\Migration;

class m170924_110431_insert_user extends Migration
{
    public function safeUp()
    {
        $this->insert('{{user}}', [
            'username' => 'admin',
            'auth_key' => \Yii::$app->security->generateRandomString(),
            'email' => 'admin@mail.ru',
            'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('123456'),
            'status' => \common\models\user\User::STATUS_ACTIVE,
            'created_at' => time(),
            'updated_at' => time(),
            'id_type_user' => 'admin',
        ]);
    }

    public function safeDown()
    {
        $this->delete('{{user}}', ['email' => 'admin@mail.ru']);
    }

}
