<?php

?>
<h2>Операции получения</h2>

<table class="table">
    <thead>
    <tr>
        <th>#</th>
        <th>Денег до</th>
        <th>Операция на сумму</th>
        <th>Платеж был отправлен</th>
        <th>Денег после</th>
    </tr>
    </thead>
    <tbody>
    <?php for($i = 0; $i < count($listSendOperations); $i++) { ?>
        <tr>
            <th scope="row"><?= $i+1; ?></th>
            <td><?= $listSendOperations[$i]->amount_from_before ?></td>
            <td><?= $listSendOperations[$i]->amount ?></td>
            <td><?= $listSendOperations[$i]->accountTo->user->email ?></td>
            <td><?= $listSendOperations[$i]->amount_from_after ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>