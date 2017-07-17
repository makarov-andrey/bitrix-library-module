<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();
?>

<? foreach ($arResult["AUTHORS"] as $author): ?>
    <a href="<?= $author["ADMIN_EDIT_URL"] ?>">[<?= $author["ID"] ?>] <?= $author["NAME"] ?></a><br>
<? endforeach ?>
