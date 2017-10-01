<?php
namespace common\services\account;

use common\models\account\Account;
use common\models\account\AccountForm;
use common\models\user\UserForm;
use common\models\user\User;
use yii\base\Object;
use yii\db\Exception;

class AccountService extends Object
{
    public $_account;

    /**
     * Constructor.
     * @param User $user
     * @param array $config
     * @throws Exception
     */
    public function __construct(Account $account, array $config = [])
    {
        $this->_account = $account;
        parent::__construct($config);
    }

    public function create(AccountForm $accountForm)
    {
        $transaction = \Yii::$app->db->beginTransaction();

        try {
            $account = $this->getModel();
            $account->setAttributes($accountForm->getAttributes($accountForm->activeAttributes()));

            if(!$account->save()) {
                throw new Exception('Ошибка при создании');
            }

            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollBack();
            \Yii::error([
                'message' => 'Ошибка при создании счета',
                'class' => implode('->', [__CLASS__, __METHOD__, __LINE__]),
                'error' => $e->getMessage()
            ], 'account');
            throw $e;
        }
    }

    /**
     * @return Account
     */
    public function getModel()
    {
        return $this->_account;
    }
}