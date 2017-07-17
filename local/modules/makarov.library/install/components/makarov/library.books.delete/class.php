<?php

use Makarov\Library\BookTable;

class LibraryBooksDelete extends CBitrixComponent
{
    function __construct($component = null)
    {
        CModule::includeModule("makarov.library");
        parent::__construct($component);
    }

    function executeComponent()
    {
        $this->postProcessing();
        if ($this->needRedirect()) {
            LocalRedirect($this->arParams["REDIRECT"]);
        }
        $this->IncludeComponentTemplate();
    }

    protected function postProcessing()
    {
        if (!$this->isPostRequest())
            return;

        $bookId = $this->getBookId();

        if (!$bookId)
            return;

        BookTable::delete($bookId);
    }

    protected function isPostRequest()
    {
        return $_SERVER["REQUEST_METHOD"] == "POST"
            && isset($_POST["book_delete"])
            && check_bitrix_sessid();
    }

    protected function needRedirect ()
    {
        return isset($this->arParams["REDIRECT"]);
    }

    protected function getBookId()
    {
        $id = (int) $_POST["id"];
        return $id > 0 ? $id : null;
    }
}