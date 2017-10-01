<?php

/* @var $modelForm \common\models\operation\SendingMoneyForm */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Перевод денег';
$this->params['breadcrumbs'][] = $this->title;
?>


<?php $form = ActiveForm::begin() ?>

    <?= $form->field($modelForm, 'email_to') ?>

    <?= $form->field($modelForm, 'amount') ?>

    <div class="form-group">
        <?= Html::submitButton('Перевести деньги', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
    </div>
<?php $form::end() ?>
