<?php
namespace common\models\user;

use common\models\account\Account;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 * @property string $id_type_user тип пользователя
 *
 * @property Account $account
 */
class TypeUser extends ActiveRecord
{
    const CONST_ADMIN = 'admin';
    const CONST_USER = 'user';
}