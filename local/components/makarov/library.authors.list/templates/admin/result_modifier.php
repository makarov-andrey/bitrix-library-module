<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Makarov\Library\AdminURL;

foreach ($arResult["AUTHORS"] as &$author) {
    $author["ADMIN_EDIT_URL"] = AdminURL::authorEdit($author["ID"]);
}
unset($author);
