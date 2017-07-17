<?php
define('ADMIN_MODULE_NAME', 'makarov.library');
require_once $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_admin_before.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_admin_after.php';
CModule::IncludeModule("makarov.library");

use Makarov\Library\AdminURL;

$APPLICATION->IncludeComponent(
    "makarov:library.authors.add",
    "admin",
    array(
        "REDIRECT_AFTER_SAVE" => AdminURL::LIBRARY_ADMIN_URL_AUTHORS
    )
);

require_once $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/epilog_admin.php';
