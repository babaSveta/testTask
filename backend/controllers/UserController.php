<?php
namespace backend\controllers;

use common\models\user\User;
use common\models\user\UserForm;
use common\services\user\UserService;
use yii\filters\AccessControl;
use yii\web\Controller;


class UserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'edit'],
                'rules' => [
                    [
                        'allow' => false,
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

    /**
     * Создание пользователя
     */
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

    /**
     * Редактирование пользователя
     *
     * @param $id
     */
    public function actionEdit($id)
    {
        $model = User::findOne($id);

        $modelForm = new UserForm();
        $modelForm->setAttributes($model->getAttributes());
        $modelForm->setScenario(UserForm::SCENARIO_UPDATE);

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