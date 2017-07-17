<?php
define('ADMIN_MODULE_NAME', 'makarov.library');
require_once $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_admin_before.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_admin_after.php';

use Bitrix\Main\UI\AdminPageNavigation;

$APPLICATION->IncludeComponent(
    "makarov:library.books.list",
    "admin",
    array(
        "CUSTOM_NAVIGATION" => new AdminPageNavigation("admin-navigation-books")
    )
);

require_once $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/epilog_admin.php';
