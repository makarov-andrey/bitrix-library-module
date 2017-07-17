<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Makarov\Library\AdminURL;
?>

<form action="<?= AdminURL::AUTHOR_DELETE ?>" method="post" style="display: none;" id="deleting_author_form">
    <?= bitrix_sessid_post() ?>
    <input type="hidden" name="author_delete">
    <input type="hidden" name="id" id="deleting_author_id_input">
</form>