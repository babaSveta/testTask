<?php

?>
<h2>Весь список операций</h2>

<table class="table">
    <thead>
    <tr>
        <th>#</th>
        <th>Денег до</th>
        <th>Операция на сумму</th>
        <th>Платеж от</th>
        <th>Платеж к</th>
        <th>Денег после</th>
    </tr>
    </thead>
    <tbody>
    <?php for($i = 0; $i < count($listAllOperations); $i++) { ?>
        <?php if($listAllOperations[$i]->id_account_from == Yii::$app->user->identity->account->id) { ?>
            <tr>
                <th scope="row"><?= $i+1 ?></th>
                <td><?= $listAllOperations[$i]->amount_from_before ?></td>
                <td>- <?= $listAllOperations[$i]->amount ?></td>
                <td><?= $listAllOperations[$i]->accountFrom->user->email ?></td>
                <td><?= $listAllOperations[$i]->accountTo->user->email ?></td>
                <td><?= $listAllOperations[$i]->amount_from_after ?></td>
            </tr>
        <?php } else { ?>
            <tr>
                <th scope="row"><?= $i+1 ?></th>
                <td><?= $listAllOperations[$i]->amount_to_before ?></td>
                <td>+ <?= $listAllOperations[$i]->amount ?></td>
                <td><?= $listAllOperations[$i]->accountFrom->user->email ?></td>
                <td><?= $listAllOperations[$i]->accountTo->user->email ?></td>
                <td><?= $listAllOperations[$i]->amount_to_after ?></td>
            </tr>
        <?php } ?>
    <?php } ?>
    </tbody>
</table>