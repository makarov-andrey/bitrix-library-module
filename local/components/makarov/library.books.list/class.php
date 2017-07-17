<?php

use Makarov\Library\BookTable;

class LibraryBooksList extends CBitrixComponent
{
    protected $books = array();

    function __construct($component = null)
    {
        CModule::includeModule("makarov.library");
        parent::__construct($component);
    }

    function executeComponent()
    {
        $this->books = BookTable::getList()->fetchAll();
        $this->compareArResult();
        $this->includeComponentTemplate();
    }

    protected function compareArResult () {
        $this->arResult["BOOKS"] = $this->books;
    }
}