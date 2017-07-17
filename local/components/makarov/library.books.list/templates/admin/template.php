<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Makarov\Library\AdminURL;

$sTableID = "tbl_books_list";
$oSort = new CAdminSorting($sTableID, "ID", "asc");
$adminList = new CAdminList($sTableID, $oSort);

$adminList->AddHeaders(Array(
    array(
        "id" => "ID",
        "content" => "ID",
        "sort" => "ID",
        "default" => "true"
    ),
    array(
        "id" => "TITLE",
        "content" => "TITLE",
        "sort" => "TITLE",
        "default" => "true"
    ),
));

$adminList->AddAdminContextMenu(array(
    array(
        "ICON" => "btn_new",
        "TEXT" => GetMessage("ADD_BUTTON"),
        "LINK" => AdminURL::AUTHOR_ADD,
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

//$adminList->setNavigation($arResult["NAVIGATION"], GetMessage("PAGES"));

$adminList->DisplayList();

?>

<form action="<?= AdminURL::BOOK_DELETE ?>" method="post" style="display: none;" id="deleting_book_form">
    <?= bitrix_sessid_post() ?>
    <input type="hidden" name="book_delete">
    <input type="hidden" name="id" id="deleting_book_id_input">
</form>
