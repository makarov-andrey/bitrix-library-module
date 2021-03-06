<?php

use Makarov\Library\AuthorTable;

class LibraryBooksDelete extends CBitrixComponent
{
    function __construct($component = null)
    {
        CModule::includeModule("makarov.library");
        parent::__construct($component);
    }

    function onPrepareComponentParams($arParams)
    {
        $arParams["DISABLE_POST_PROCESSING"] = $arParams["DISABLE_POST_PROCESSING"] === true;
        return parent::onPrepareComponentParams($arParams);
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

        $bookId = $this->getAuthorId();

        if (!$bookId)
            return;

        AuthorTable::delete($bookId);
    }

    protected function isPostRequest()
    {
        return $_SERVER["REQUEST_METHOD"] == "POST"
            && !$this->arParams["DISABLE_POST_PROCESSING"]
            && isset($_POST["author_delete"])
            && check_bitrix_sessid();
    }

    protected function needRedirect ()
    {
        return isset($this->arParams["REDIRECT"]);
    }

    protected function getAuthorId()
    {
        $id = (int) $_POST["id"];
        return $id > 0 ? $id : null;
    }
}