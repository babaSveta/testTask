<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\Modal;

$this->title = 'Список пользователей';
?>

<table class="table">
    <thead>
    <tr>
        <th>#</th>
        <th>id</th>
        <th>Username</th>
        <th>Email</th>
        <th>Создан</th>
        <th>Тип пользователя</th>
        <th>Количество денег</th>
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>
    <?php for($i = 0; $i < count($users); $i++) { ?>
        <tr>
        <tr>
            <th scope="row"><?= $i+1 ?></th>
            <td><?= $users[$i]->id ?></td>
            <td><?= $users[$i]->username ?></td>
            <td><?= $users[$i]->email ?></td>
            <td><?= Yii::$app->formatter->asDate($users[$i]->created_at) ?></td>
            <td><?= $users[$i]->id_type_user ?></td>
            <td><?= $users[$i]->account->amount ?> р.</td>
            <td>
                <?php echo Html::a(Html::button('Редактиовать', ['class' => 'btn btn-success']), 'index.php?r=user%2Fedit&id=' . $users[$i]->id)?>
            </td>
        </tr>
    <?php } ?>
    </tbody>


</table>