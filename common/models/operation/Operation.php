<?php
namespace common\models\operation;

use common\models\account\Account;
use yii\db\ActiveRecord;

/**
 * Operation model
 *
 * @property integer $id
 * @property integer $id_user_created
 * @property integer $id_account_from
 * @property integer $id_account_to
 * @property float $amount
 * @property float $amount_from_before
 * @property float $amount_from_after
 * @property float $amount_to_before
 * @property float $amount_to_after
 *
 * @property Account $accountFrom
 * @property Account $accountTo
 */

class Operation extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%operation}}';
    }

    public function safeAttributes()
    {
        return ['id_user_created', 'id_account_from', 'id_account_to', 'amount'];
    }

    public function getAccountFrom()
    {
        return $this->hasOne(Account::className(), ['id' => 'id_account_from']);
    }

    public function getAccountTo()
    {
        return $this->hasOne(Account::className(), ['id' => 'id_account_to']);
    }
}
