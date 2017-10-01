<?php
namespace common\models\operation;

use common\models\account\Account;
use common\models\user\User;
use yii\base\Model;

class SendingMoneyForm extends Model
{
    public $email_to;
    public $email_from;
    public $amount;
    public $id_account_from;
    public $id_account_to;

    public function rules()
    {
        return [
            [['email_to', 'amount'], 'required'],

            ['email_to', 'email'],
            [['email_to'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['email_to' => 'email']],
            // проверка, чтобы не отправлял себе
            ['email_to', 'compare', 'compareValue' => \Yii::$app->user->identity->email, 'operator' => '!=', 'message' => 'Вы не можете отправлять себе деньги'],

            [['amount'], 'number', 'min' => 0, 'max' => 2000000000],
            [['amount'], 'compare', 'compareValue' => 0, 'operator' => '>'],

            ['id_account_to', 'default', 'value' => function ($model, $attribute) {
                return Account::getIdByEmail($model->email_to);
            }],
            ['id_account_from', 'default', 'value' => function ($model, $attribute) {
                $idEmailFrom = Account::getIdByEmail($model->email_from);
                return !is_null($idEmailFrom) ?
                    $idEmailFrom :
                    \Yii::$app->user->identity->account->id;
            }],
        ];
    }
}