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
    <input type="hidden" name="sessid" value="<?= bitrix_sessid() ?>">
    <input type="hidden" name="book_add_form">

    <?php
    $tabControl = new CAdminTabControl("tabControl", array($tabParams));
    $tabControl->Begin();
    $tabControl->BeginNextTab();
    ?>
    <? if(!empty($arResult["BOOK"])): ?>
        <tr>
            <td class="adm-detail-content-cell-l">ID:</td>
            <td class="adm-detail-content-cell-r"><?= $arResult["BOOK"]["ID"] ?></td>
        </tr>
    <? endif ?>

    <tr class="adm-detail-required-field">
        <td class="adm-detail-content-cell-l">
            <label for="title">Название:</label>
        </td>
        <td class="adm-detail-content-cell-r">
            <input type="text" name="title" value="<?= $arResult["BOOK"]["TITLE"] ?>" id="title">
        </td>
    </tr>

    <tr>
        <td class="adm-detail-content-cell-l">
            <label for="authors">Авторы:</label>
        </td>
        <td class="adm-detail-content-cell-r">
            <select name="authors[]" id="authors" multiple>
                <? foreach($arResult["AUTHORS"] as $author): ?>
                    <option value="<?= $author["ID"] ?>" <?= ($author["SELECTED"] ? "selected" : "") ?>>
                        [<?= $author["ID"] ?>] <?= $author["NAME"] ?>
                    </option>
                <? endforeach ?>
            </select>
        </td>
    </tr>

    <?php
    $tabControl->Buttons(array(
        "disabled" => false,
        "back_url" => AdminURL::LIBRARY_ADMIN_URL_BOOKS
    ));
    $tabControl->End();
    ?>
</form>