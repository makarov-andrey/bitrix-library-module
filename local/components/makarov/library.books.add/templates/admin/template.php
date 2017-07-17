<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Makarov\Library\AdminURL;

$tabParams = array(
    "DIV" => "editBook",
    "TAB" => GetMessage("TAB_NAME")
);
if (!empty($arResult["BOOK"])) {
    $tabParams["TITLE"] = GetMessage("TITLE_EDIT", $arResult["BOOK"]);
} else {
    $tabParams["TITLE"] = GetMessage("TITLE_ADD");
}
?>

<form action="<?= $APPLICATION->GetCurPageParam() ?>" method="post">
    <?php
    $tabControl = new CAdminTabControl("tabControl", array($tabParams));
    $tabControl->Begin();
    $tabControl->BeginNextTab();
    ?>

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

    <?php
    $tabControl->Buttons(array(
        "disabled" => false,
        "back_url" => AdminURL::LIBRARY_ADMIN_URL_BOOKS
    ));
    $tabControl->End();
    ?>
</form>