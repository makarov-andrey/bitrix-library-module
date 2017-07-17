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
        $arParams["BOOK_ID_GET_PARAMETER"] = (string)$arParams["BOOK_ID_GET_PARAMETER"];
        if (empty($arParams["BOOK_ID_GET_PARAMETER"])) {
            $arParams["BOOK_ID_GET_PARAMETER"] = "id";
        }
        return parent::onPrepareComponentParams($arParams);
    }

    function executeComponent()
    {
        $this->postProcessing();

        $this->book = BookTable::getByIdWithAuthors($this->getBookId());
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

        $bookId = $this->getBookId();
        $redirectURL = null;

        if ($bookId) {
            BookTable::update($bookId, $book);
        } else {
            $addResult = BookTable::add($book);
            $bookId = $addResult->getId();
            $redirectURL = $this->getEditURL($bookId);
        }

        $authors = $_POST["authors"];
        BookAuthorTable::saveAuthorsForBook($bookId, $authors);

        if (!$redirectURL && $this->needRedirect()) {
            $redirectURL = $this->arParams["REDIRECT_AFTER_SAVE"];
        }
        if ($redirectURL) {
            LocalRedirect($redirectURL);
        }
    }

    protected function isPostRequest()
    {
        return $_SERVER["REQUEST_METHOD"] == "POST"
            && isset($_POST["book_edit_form"])
            && check_bitrix_sessid();
    }

    protected function needRedirect ()
    {
        return isset($_POST["save"]) && isset($this->arParams["REDIRECT_AFTER_SAVE"]);
    }

    protected function getEditURL ($bookId)
    {
        global $APPLICATION;
        return $APPLICATION->GetCurPageParam(
            $this->arParams["BOOK_ID_GET_PARAMETER"] . "=" . $bookId,
            $this->arParams["BOOK_ID_GET_PARAMETER"]
        );
    }

    protected function getBookId()
    {
        $id = (int) $_GET[$this->arParams["BOOK_ID_GET_PARAMETER"]];
        return $id > 0 ? $id : null;
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