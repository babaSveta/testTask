<?php

namespace backend\controllers;

use common\models\operation\Operation;
use common\models\user\User;
use common\models\user\UserForm;
use common\services\user\UserService;
use yii\web\Controller;


class OperationController extends Controller
{
    public function actionIndex()
    {
        $operations = Operation::find()->all();

        return $this->render('index',[
            'operations' => $operations,
        ]);
    }
}