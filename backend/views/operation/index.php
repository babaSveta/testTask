<?php

?>
<h2>Весь список операций</h2>

<table class="table">
    <thead>
    <tr>
        <th>#</th>
        <th>Дата создания</th>
        <th>От пользователя</th>
        <th>К пользователю</th>
        <th>Совершил операцию</th>
        <th>На сумму</th>
        <th>Денег у отп. после</th>
        <th>Денег у пол. после</th>
    </tr>
    </thead>
    <tbody>
    <?php for($i = 0; $i < count($operations); $i++) { ?>
        <tr>
            <th scope="row"><?= $i+1 ?></th>
            <td><?= Yii::$app->formatter->asDate($operations[$i]->accounted_at) ?></td>
            <td><?= $operations[$i]->accountFrom->user->email ?></td>
            <td><?= $operations[$i]->accountTo->user->email ?></td>
            <td><?= $operations[$i]->userCreated->id_type_user ?></td>
            <td><?= $operations[$i]->amount ?></td>
            <td><?= $operations[$i]->amount_from_after ?></td>
            <td><?= $operations[$i]->amount_to_after ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>