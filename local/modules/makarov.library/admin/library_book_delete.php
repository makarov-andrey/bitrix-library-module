<?php
define('ADMIN_MODULE_NAME', 'makarov.library');
require_once $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_admin_before.php';
CModule::IncludeModule("makarov.library");

use Makarov\Library\AdminURL;

$APPLICATION->IncludeComponent(
    "makarov:library.books.delete",
    "",
    array(
        "REDIRECT" => AdminURL::BOOKS_LIST
    )
);
