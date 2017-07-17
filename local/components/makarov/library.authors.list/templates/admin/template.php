<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Makarov\Library\AdminURL;

$sTableID = "tbl_authors_list";
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
        "id" => "NAME",
        "content" => "NAME",
        "sort" => "NAME",
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

foreach ($arResult["AUTHORS"] as $author) {
    $rowId = $sTableID . "_" . $author["ID"];
    $editLink = AdminURL::authorEdit($author["ID"]);

    $row = $adminList->AddRow($rowId, $author, $editLink);

    $row->AddViewField("ID", '<a href="' . $editLink . '">' . $author["ID"] . '</a>');
    $row->AddViewField("NAME", $author["NAME"]);

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
            "ACTION" => "deleteAuthorRedirect(" . $author["ID"] . ")"
        )
    );

    $row->AddActions($arActions);
}

//$adminList->setNavigation($arResult["NAVIGATION"], GetMessage("PAGES"));

$adminList->DisplayList();

?>

<form action="<?= AdminURL::AUTHOR_DELETE ?>" method="post" style="display: none;" id="deleting_author_form">
    <?= bitrix_sessid_post() ?>
    <input type="hidden" name="author_delete">
    <input type="hidden" name="id" id="deleting_author_id_input">
</form>
