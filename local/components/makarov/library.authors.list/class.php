<?php

use Makarov\Library\AuthorTable;

class LibraryBooksList extends CBitrixComponent
{
    public $books = array();

    public function __construct($component = null)
    {
        CModule::includeModule("makarov.library");
        parent::__construct($component);
    }

    public function executeComponent()
    {
        $this->books = $this->getData();
        $this->arResult["AUTHORS"] = $this->books;
        $this->includeComponentTemplate();
    }

    public function getData () {
        $result = AuthorTable::getList(array(
            "select" => array("*")
        ));
        return $result->fetchAll();
    }
}