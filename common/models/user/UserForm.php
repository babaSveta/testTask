<?php
namespace common\models\user;

use yii\base\Model;

class UserForm extends Model
{
    const SCENARIO_UPDATE = 'update';

    public $username;
    public $email;
    public $password;
    public $id_type_user;

    public function rules()
    {
        return [
            [['email', 'password', 'username'], 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => 'common\models\user\User'],
            ['password', 'string', 'min' => 2, 'max' => 10],
            ['username', 'string', 'max' => 254],

            ['id_type_user', 'required'],
            ['id_type_user', 'string'],
            [['id_type_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_type_user' => 'id_type_user']],
        ];
    }

    public function scenarios()
    {
        return array_merge(parent::scenarios(), [
            'default' => ['email', 'password', 'username'],
            'update' => ['email', 'username', 'id_type_user'],
        ]);
    }
}