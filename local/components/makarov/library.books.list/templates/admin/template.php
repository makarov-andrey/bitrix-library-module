<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Makarov\Library\AdminURL;

$APPLICATION->IncludeComponent(
    "makarov:library.authors.delete",
    "js_redirect",
    array(
        "DISABLE_POST_PROCESSING" => true
    )
);

/*
 * Битрикс не умеет работать с буфером, если вызвать prolog_admin_after.php
 * раньше, чем CAdminList::prolog_admin_after поэтому помогаем ему костылём.
 */
if($_REQUEST["mode"] == 'list' || $_REQUEST["mode"] == 'frame' || $_REQUEST["mode"] == 'settings') {
    $APPLICATION->RestartBuffer();
}

$sTableID = "tbl_books_list";
$adminList = new CAdminList($sTableID);

$adminList->AddHeaders(Array(
    array(
        "id" => "ID",
        "content" => "ID",
        "default" => "true"
    ),
    array(
        "id" => "TITLE",
        "content" => "TITLE",
        "default" => "true"
    ),
));

$adminList->AddAdminContextMenu(array(
    array(
        "ICON" => "btn_new",
        "TEXT" => GetMessage("ADD_BUTTON"),
        "LINK" => AdminURL::BOOK_ADD,
        "LINK_PARAM" => "",
        "TITLE" => GetMessage("ADD_BUTTON_TITLE")
    )
));

foreach ($arResult["BOOKS"] as $book) {
    $rowId = $sTableID . "_" . $book["ID"];
    $editLink = AdminURL::bookEdit($book["ID"]);

    $row = $adminList->AddRow($rowId, $book, $editLink);

    $row->AddViewField("ID", '<a href="' . $editLink . '">' . $book["ID"] . '</a>');
    $row->AddViewField("TITLE", $book["TITLE"]);

    $arActions = Array(
        array(
            "ICON" => "edit",
            "DEFAULT" => false,
            "TEXT" => "Редактировать",
            "ACTION" => $adminList->ActionRedirect($editLink)
        ),
        array(
            "ICON" => "delete",
            "DEFAULT" => false,
            "TEXT" => "Удалить",
            "ACTION" => "deleteBookRedirect(" . $book["ID"] . ")"
        )
    );

    $row->AddActions($arActions);
}

$adminList->setNavigation($arResult["NAVIGATION"], GetMessage("PAGER_TITLE"));

$adminList->CheckListMode();

$adminList->DisplayList();
