<?php

use Makarov\Library\AuthorTable;

class LibraryAuthorsList extends CBitrixComponent
{
    protected $authors = array();

    function __construct($component = null)
    {
        CModule::includeModule("makarov.library");
        parent::__construct($component);
    }

    function executeComponent()
    {
        $this->authors = AuthorTable::getList()->fetchAll();
        $this->compareArResult();
        $this->includeComponentTemplate();
    }

    protected function compareArResult () {
        $this->arResult["AUTHORS"] = $this->authors;
    }
}