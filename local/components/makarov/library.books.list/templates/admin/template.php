<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();
?>

<? foreach ($arResult["BOOKS"] as $book): ?>
    <a href="<?= $book["ADMIN_EDIT_URL"] ?>"><?= $book["TITLE"] ?></a><br>
<? endforeach ?>
