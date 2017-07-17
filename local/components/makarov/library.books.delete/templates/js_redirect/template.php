<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Makarov\Library\AdminURL;
?>

<form action="<?= AdminURL::BOOK_DELETE ?>" method="post" style="display: none;" id="deleting_book_form">
    <?= bitrix_sessid_post() ?>
    <input type="hidden" name="book_delete">
    <input type="hidden" name="id" id="deleting_book_id_input">
</form>