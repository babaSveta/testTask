<?php

namespace backend\controllers;

use common\models\operation\Operation;
use yii\filters\AccessControl;
use yii\web\Controller;


class OperationController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'allow' => false,
                        'verbs' => ['POST'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Все операции
     */
    public function actionIndex()
    {
        $operations = Operation::find()->all();

        return $this->render('index',[
            'operations' => $operations,
        ]);
    }

    /**
     * Все операции по определённому пользоватлю
     *
     * @param $idUser
     */
    public function actionAllOperationsUser($idUser)
    {
        $listAllOperations = Operation::find()->where([
            'id_account_to' => $idUser
        ])->orWhere([
            'id_account_from' => $idUser
        ])->all();

        return $this->render('all-operations-user',[
            'listAllOperations' => $listAllOperations,
            'idUser' => $idUser,
        ]);
    }
}