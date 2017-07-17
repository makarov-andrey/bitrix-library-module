<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Makarov\Library\AdminURL;

$tabParams = array(
    "DIV" => "editBook",
    "TAB" => GetMessage("TAB_NAME")
);
if (!empty($arResult["AUTHOR"])) {
    $tabParams["TITLE"] = GetMessage("TITLE_EDIT", $arResult["AUTHOR"]);
} else {
    $tabParams["TITLE"] = GetMessage("TITLE_ADD");
}
?>

<form action="<?= $APPLICATION->GetCurPageParam() ?>" method="post">
    <input type="hidden" name="sessid" value="<?= bitrix_sessid() ?>">
    <input type="hidden" name="author_edit">

    <?php
    $tabControl = new CAdminTabControl("tabControl", array($tabParams));
    $tabControl->Begin();
    $tabControl->BeginNextTab();
    ?>
    <? if(!empty($arResult["AUTHOR"])): ?>
        <tr>
            <td class="adm-detail-content-cell-l"><?= GetMessage("ID") ?>:</td>
            <td class="adm-detail-content-cell-r"><?= $arResult["AUTHOR"]["ID"] ?></td>
        </tr>
    <? endif ?>

    <tr class="adm-detail-required-field">
        <td class="adm-detail-content-cell-l">
            <label for="name"><?= GetMessage("NAME") ?>:</label>
        </td>
        <td class="adm-detail-content-cell-r">
            <input type="text" name="name" value="<?= $arResult["AUTHOR"]["NAME"] ?>" id="name">
        </td>
    </tr>

    <tr>
        <td class="adm-detail-content-cell-l">
            <label for="books"><?= GetMessage("BOOKS") ?>:</label>
        </td>
        <td class="adm-detail-content-cell-r">
            <select name="books[]" id="books" multiple>
                <? foreach($arResult["BOOKS"] as $book): ?>
                    <option value="<?= $book["ID"] ?>" <?= ($book["SELECTED"] ? "selected" : "") ?>>
                        [<?= $book["ID"] ?>] <?= $book["TITLE"] ?>
                    </option>
                <? endforeach ?>
            </select>
        </td>
    </tr>

    <?php
    $tabControl->Buttons(array(
        "disabled" => false,
        "back_url" => AdminURL::BOOKS_LIST
    ));
    $tabControl->End();
    ?>
</form>