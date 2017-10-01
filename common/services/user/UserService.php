<?php
namespace common\services\user;
use common\models\account\Account;
use common\models\account\AccountForm;
use common\models\user\UserForm;
use common\models\user\User;
use common\services\account\AccountService;
use yii\base\Object;
use yii\db\Exception;

class UserService extends Object
{
    public $_user;

    /**
     * Constructor.
     * @param User $user
     * @param array $config
     * @throws Exception
     */
    public function __construct(User $user, array $config = [])
    {
        $this->_user = $user;
        parent::__construct($config);
    }

    public function create(UserForm $userForm)
    {
        $transaction = \Yii::$app->db->beginTransaction();

        try {
            $user = $this->getModel();
            $user->setAttributes($userForm->getAttributes($userForm->activeAttributes()));

            if(!$user->save()) {
                throw new Exception('Ошибка при создании');
            }

            // создание счета
            $accountService = new AccountService(new Account());
            $accountForm = new AccountForm();
            $accountForm->id_user = $user->id;
            $accountForm->amount = 0;
            $accountService->create($accountForm);

            $transaction->commit();
            return $user;
        } catch (Exception $e) {
            $transaction->rollBack();
            \Yii::error([
                'message' => 'Ошибка при создании пользователя',
                'class' => implode('->', [__CLASS__, __METHOD__, __LINE__]),
                'error' => $e->getMessage()
            ], 'user');
            throw $e;
        }
    }

    public function edit(UserForm $userForm)
    {
        $transaction = \Yii::$app->db->beginTransaction();

        try {
            $user = $this->getModel();
            $user->setAttributes($userForm->getAttributes($userForm->activeAttributes()));

            if(!$user->save()) {
                throw new Exception('Ошибка при редактировании');
            }

            $transaction->commit();
            return $user;
        } catch (Exception $e) {
            $transaction->rollBack();
            \Yii::error([
                'message' => 'Ошибка при редактировании пользователя',
                'class' => implode('->', [__CLASS__, __METHOD__, __LINE__]),
                'error' => $e->getMessage()
            ], 'user');
            throw $e;
        }
    }

    /**
     * @return User
     */
    public function getModel()
    {
        return $this->_user;
    }
}