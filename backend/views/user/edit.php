<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $modelForm \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \common\models\user\TypeUser;

$this->title = 'Редактирование пользователя';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <?= $form->field($modelForm, 'username')->textInput(['autofocus' => true]) ?>
            <?= $form->field($modelForm, 'email') ?>
            <?= $form->field($modelForm, 'password')->passwordInput() ?>
            <?= $form->field($modelForm, 'id_type_user')->dropDownList([
                TypeUser::CONST_ADMIN => 'Администратор',
                TypeUser::CONST_USER => 'Пользователь'
            ]) ?>

            <div class="form-group">
                <?= Html::submitButton('Редактировать пользователя', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>