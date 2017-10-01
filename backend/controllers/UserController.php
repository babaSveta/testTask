<?php
namespace backend\controllers;

use common\models\user\User;
use common\models\user\UserForm;
use common\services\user\UserService;
use yii\web\Controller;


class UserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionCreate()
    {
        $modelForm = new UserForm();

        if (\Yii::$app->request->post() && $modelForm->load(\Yii::$app->request->post())) {
            if ($modelForm->validate()) {
                $userService = new UserService(new User());

                $userService->create($modelForm);
            }

            return $this->redirect('index.php?r=site%2Findex');
        }

        return $this->render('create', [
            'modelForm' => $modelForm,
        ]);
    }

    public function actionEdit($id)
    {
        $modelForm = new UserForm();
        $modelForm->setScenario('update');

        $model = User::findOne($id);

        $modelForm->setAttributes($model->getAttributes());

        if (\Yii::$app->request->post() && $modelForm->load(\Yii::$app->request->post())) {
            if ($modelForm->validate()) {
                $userService = new UserService(new User());

                $userService->edit($modelForm);
            }

            return $this->redirect('index.php?r=site%2Findex');
        }

        return $this->render('edit', [
            'model' => $model,
            'modelForm' => $modelForm,
        ]);
    }
}