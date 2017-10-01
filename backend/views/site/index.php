<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\Modal;

$this->title = 'Список пользователей';
?>
<h2>Список пользователей</h2>
<table class="table">
    <thead>
    <tr>
        <th>id</th>
        <th>Username</th>
        <th>Email</th>
        <th>Создан</th>
        <th>Тип пользователя</th>
        <th>Количество денег</th>
        <th>Действия</th>
        <th>История операций</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user) { ?>
        <tr>
            <td><?= $user->id ?></td>
            <td><?= $user->username ?></td>
            <td><?= $user->email ?></td>
            <td><?= Yii::$app->formatter->asDate($user->created_at) ?></td>
            <td><?= $user->id_type_user ?></td>
            <td><?= $user->account->amount ?> р.</td>
            <td>
                <?php echo Html::a(Html::button('Редак.', ['class' => 'btn btn-success']), 'index.php?r=user%2Fedit&id=' . $user->id)?>
            </td>
            <td>
                <?php echo Html::a(Html::button('Посм.', ['class' => 'btn btn-success']), 'index.php?r=operation%2Fall-operations-user&idUser=' . $user->id)?>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<div class="text-right">
<?= \yii\widgets\LinkPager::widget([
    'pagination' => $pages,

]); ?>
</div>
