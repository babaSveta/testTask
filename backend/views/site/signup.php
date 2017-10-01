<?php
    use \yii\widgets\ActiveForm;
?>

    <h1>Регистрация</h1>

    <?php $form = ActiveForm::begin(['class' => 'form-horizontal']); ?>
        <?= $form->field($modelForm, 'username') ?>
        <?= $form->field($modelForm, 'email') ?>
        <?= $form->field($modelForm, 'password')->passwordInput() ?>

        <div>
            <?= \yii\helpers\Html::submitButton('Submit')?>
        </div>

    <?php ActiveForm::end(); ?>

