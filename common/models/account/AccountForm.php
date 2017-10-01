<?php
namespace common\models\account;

use yii\base\Model;

class AccountForm extends Model
{
    public $id_user;
    public $amount;

    public function rules()
    {
        return [
            [['id_user'], 'required'],
            [['amount'], 'default', 'value' => '0'],
            [['id_user', 'amount'], 'safe']
        ];
    }
}