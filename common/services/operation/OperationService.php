<?php
namespace common\services\operation;

use common\models\account\Account;
use common\models\account\AccountForm;
use common\models\operation\Operation;
use common\models\operation\SendingMoneyForm;
use common\models\user\UserForm;
use common\models\user\User;
use yii\base\Object;
use yii\db\Exception;
use Yii;

class OperationService extends Object
{
    public $_operation;

    public function __construct(Operation $operation, array $config = [])
    {
        $this->_operation = $operation;
        $this->_operation->id_user_created = Yii::$app->user->identity->getId();

        parent::__construct($config);
    }

    public function move(SendingMoneyForm $operationForm)
    {
        $transaction = \Yii::$app->db->beginTransaction();

        try {
            $operation = $this->getModel();
            $operation->setAttributes($operationForm->getAttributes($operationForm->activeAttributes()));

            $accountFrom = $operation->accountFrom;
            $accountTo = $operation->accountTo;

            // данные до и после перевода
            $operation->amount_from_before = $accountFrom->amount;
            $operation->amount_to_before = $accountTo->amount;
            $operation->amount_from_after = $accountFrom->amount - $operation->amount;
            $operation->amount_to_after = $accountTo->amount + $operation->amount;

            if (($accountFrom->amount - $operation->amount) < 0) {
                throw new Exception('Перевод невозможен. Недостаточно средств');
            }

            $accountFrom->amount -= $operation->amount;
            $accountTo->amount += $operation->amount;

            if(!$operation->save()) {
                throw new Exception('Ошибка при создании');
            }

            if (!$accountFrom->save() || !$accountTo->save()) {
                throw new Exception('Ошибка при сохранении счетов');
            };

            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollBack();
            \Yii::error([
                'message' => 'Ошибка при переводе денег',
                'class' => implode('->', [__CLASS__, __METHOD__, __LINE__]),
                'error' => $e->getMessage()
            ], 'account');
            throw $e;
        }
    }

    /**
     * @return Operation
     */
    public function getModel()
    {
        return $this->_operation;
    }
}