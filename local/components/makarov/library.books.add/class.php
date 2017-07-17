<?php

use Makarov\Library\BookTable;
use Makarov\Library\AuthorTable;
use Makarov\Library\BookAuthorTable;

class LibraryBooksAdd extends CBitrixComponent
{
    protected $book = null;
    protected $authors = array();
    protected $errors = array();

    function __construct($component = null)
    {
        CModule::includeModule("makarov.library");
        parent::__construct($component);
    }


    function onPrepareComponentParams($arParams)
    {
        $arParams["ID"] = (int)$arParams["ID"];
        if ($arParams["ID"] <= 0) {
            unset($arParams["ID"]);
        }
        return parent::onPrepareComponentParams($arParams);
    }

    function executeComponent()
    {
        $this->postProcessing();
        $this->book = BookTable::getByIdWithAuthors($this->arParams["ID"]);
        $this->authors = AuthorTable::getList()->fetchAll();
        $this->markSelectedAuthors();
        $this->compareArResult();
        $this->includeComponentTemplate();
    }

    protected function postProcessing()
    {
        if (!$this->isPostRequest())
            return;

        $book = array(
            "TITLE" => $_POST["title"]
        );

        if (isset($this->arParams["ID"])) {
            BookTable::update($this->arParams["ID"], $book);
        } else {
            $addResult = BookTable::add($book);
            $this->arParams["ID"] = $addResult->getId();
        }

        $authors = $_POST["authors"];
        BookAuthorTable::saveAuthorsForBook($this->arParams["ID"], $authors);
    }

    protected function isPostRequest()
    {
        return $_SERVER["REQUEST_METHOD"] == "POST"
            && isset($_POST["book_add_form"])
            && check_bitrix_sessid();
    }

    protected function markSelectedAuthors()
    {
        if (!$this->book)
            return;

        foreach ($this->authors as &$author) {
            $author["SELECTED"] = false;
            foreach ($this->book["AUTHORS"] as $selectedAuthor) {
                if ($selectedAuthor["ID"] == $author["ID"]) {
                    $author["SELECTED"] = true;
                    break;
                }
            }
        }
        unset($author);
    }

    protected function compareArResult()
    {
        $this->arResult["BOOK"] = $this->book;
        $this->arResult["AUTHORS"] = $this->authors;
        $this->arResult["ERRORS"] = $this->errors;
    }
}