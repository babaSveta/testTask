<?php

?>
<h2>Операции получения</h2>

<table class="table">
    <thead>
    <tr>
        <th>#</th>
        <th>Денег до</th>
        <th>Операция на сумму</th>
        <th>Платеж пришёл от</th>
        <th>Денег после</th>
    </tr>
    </thead>
    <tbody>
    <?php for($i = 0; $i < count($listAcceptOperations); $i++) { ?>
        <tr>
        <tr>
            <th scope="row"><?= $i+1 ?></th>
            <td><?= $listAcceptOperations[$i]->amount_to_before ?></td>
            <td><?= $listAcceptOperations[$i]->amount ?></td>
            <td><?= $listAcceptOperations[$i]->accountFrom->user->email ?></td>
            <td><?= $listAcceptOperations[$i]->amount_to_after ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>