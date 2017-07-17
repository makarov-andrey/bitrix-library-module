<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();
?>

<form action="<?= $APPLICATION->GetCurPageParam() ?>" method="post">
    <input type="hidden" name="sessid" value="<?= bitrix_sessid() ?>">
    <input type="hidden" name="book_add_form">

    <? if(!empty($arResult["BOOK"])): ?>
        ID: <?= $arResult["BOOK"]["ID"] ?>
        <br>
    <? endif ?>

    <label for="title">Название:</label>
    <input type="text" name="title" value="<?= $arResult["BOOK"]["TITLE"] ?>" id="title">
    <br>

    <label for="authors">Авторы:</label>
    <select name="authors[]" id="authors" multiple>
        <? foreach($arResult["AUTHORS"] as $author): ?>
            <option value="<?= $author["ID"] ?>" <?= ($author["SELECTED"] ? "selected" : "") ?>>
                [<?= $author["ID"] ?>] <?= $author["NAME"] ?>
            </option>
        <? endforeach ?>
    </select>
    <br>

    <input type="submit" value="Сохранить">
</form>