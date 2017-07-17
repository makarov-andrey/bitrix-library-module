<?php

use Makarov\Library\BookTable;
use Makarov\Library\AuthorTable;
use Makarov\Library\BookAuthorTable;

class LibraryAuthorsAdd extends CBitrixComponent
{
    protected $author = null;
    protected $books = array();
    protected $errors = array();

    function __construct($component = null)
    {
        CModule::includeModule("makarov.library");
        parent::__construct($component);
    }


    function onPrepareComponentParams($arParams)
    {
        $arParams["AUTHOR_ID_GET_PARAMETER"] = (string)$arParams["AUTHOR_ID_GET_PARAMETER"];
        if (empty($arParams["AUTHOR_ID_GET_PARAMETER"])) {
            $arParams["AUTHOR_ID_GET_PARAMETER"] = "id";
        }
        return parent::onPrepareComponentParams($arParams);
    }

    function executeComponent()
    {
        $this->postProcessing();
        $this->author = AuthorTable::getByIdWithBooks($this->getAuthorId());
        $this->books = BookTable::getList()->fetchAll();
        $this->markSelectedBooks();
        $this->compareArResult();
        $this->includeComponentTemplate();
    }

    protected function postProcessing()
    {
        if (!$this->isPostRequest())
            return;

        $author = array(
            "NAME" => $_POST["name"]
        );

        $authorId = $this->getAuthorId();
        $redirectURL = null;

        if ($authorId) {
            AuthorTable::update($authorId, $author);
        } else {
            $addResult = AuthorTable::add($author);
            $authorId = $addResult->getId();
            $redirectURL = $this->getEditURL($authorId);
        }

        $books = $_POST["books"];
        BookAuthorTable::saveBooksForAuthor($authorId, $books);

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
            && isset($_POST["author_add_form"])
            && check_bitrix_sessid();
    }

    protected function needRedirect ()
    {
        return isset($_POST["save"]) && isset($this->arParams["REDIRECT_AFTER_SAVE"]);
    }

    protected function getEditURL ($authorId)
    {
        global $APPLICATION;
        return $APPLICATION->GetCurPageParam(
            $this->arParams["AUTHOR_ID_GET_PARAMETER"] . "=" . $authorId,
            $this->arParams["AUTHOR_ID_GET_PARAMETER"]
        );
    }

    protected function getAuthorId()
    {
        $id = (int) $_GET[$this->arParams["AUTHOR_ID_GET_PARAMETER"]];
        return $id > 0 ? $id : null;
    }

    protected function markSelectedBooks()
    {
        if (!$this->author)
            return;

        foreach ($this->books as &$book) {
            $book["SELECTED"] = false;
            foreach ($this->author["BOOKS"] as $selectedBook) {
                if ($selectedBook["ID"] == $book["ID"]) {
                    $book["SELECTED"] = true;
                    break;
                }
            }
        }
        unset($book);
    }

    protected function compareArResult()
    {
        $this->arResult["AUTHOR"] = $this->author;
        $this->arResult["BOOKS"] = $this->books;
        $this->arResult["ERRORS"] = $this->errors;
    }
}