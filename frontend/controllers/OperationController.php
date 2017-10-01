<?php
namespace frontend\controllers;

use common\models\operation\SendingMoneyForm;
use common\models\operation\Operation;
use common\services\operation\OperationService;
use Yii;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class OperationController extends \yii\web\Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['list-send', 'list-accept', 'sending-money', 'list-all'],
                'rules' => [
                    [
                        'allow' => false,
                        'verbs' => ['POST']
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    // список отправленных операций
    public function actionListSend()
    {
        $listSendOperations = Operation::findAll(['id_account_from' => Yii::$app->user->identity->account->id]);

        return $this->render('list-send', [
            'listSendOperations' => $listSendOperations,
        ]);
    }

    // список принятых операций
    public function actionListAccept()
    {
        $listAcceptOperations = Operation::findAll(['id_account_to' => Yii::$app->user->identity->account->id]);

        return $this->render('list-accept', [
            'listAcceptOperations' => $listAcceptOperations,
        ]);
    }

    // Список всех операций
    public function actionListAll()
    {
        $listAllOperations = Operation::find()->where([
            'id_account_to' => Yii::$app->user->identity->account->id
        ])->orWhere([
            'id_account_from' => Yii::$app->user->identity->account->id
        ])->all();

        return $this->render('list-all', [
            'listAllOperations' => $listAllOperations,
        ]);
    }

    // Отправление денег
    public function actionSendingMoney()
    {
        $modelForm = new SendingMoneyForm();

        if (Yii::$app->request->post() && $modelForm->load(Yii::$app->request->post())) {
            if ($modelForm->validate()) {
                $operationService = new OperationService(new Operation());

                $operationService->move($modelForm);
            }
        }

        return $this->render('sending-money', [
            'modelForm' => $modelForm,
        ]);
    }
}