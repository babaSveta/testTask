<?php
namespace common\models\account;

use common\models\operation\Operation;
use common\models\user\User;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property integer $id_user
 * @property float $amount
 *
 * @property User $user
 */
class Account extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%account}}';
    }

    public function safeAttributes()
    {
        return ['id_user', 'amount'];
    }

    public static function getIdByEmail($email)
    {
        $user = User::findByEmail($email);

        if (is_null($user))
            return null;

        return $user->account->id;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

    /**
     * @return Operation
     */
    public function getOperation()
    {
        return $this->hasMany(Operation::className(), ['id' => 'id_user']);
    }
}
