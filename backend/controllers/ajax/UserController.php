<?php
class UserController extends \yii\web\Controller
{
    /**
     * @param \yii\base\Action $action
     * @return bool
     */
    public function beforeAction($action)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return true;
    }

    public function actionEditUser($id)
    {
        $modelForm = new \common\models\user\UserForm();
        $model = new \common\models\user\User();

        $model = \common\models\user\User::findOne($id);
        $modelForm->scenario = $modelForm::SCENARIO_DEFAULT;
        $modelForm->prepareUpdate($model);
    }
}