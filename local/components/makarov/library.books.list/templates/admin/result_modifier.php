<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Makarov\Library\AdminURL;

foreach ($arResult["BOOKS"] as &$book) {
    $book["ADMIN_EDIT_URL"] = AdminURL::getBookEditURL($book["ID"]);
}
unset($book);
