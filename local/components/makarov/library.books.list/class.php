<?php

use Makarov\Library\BookTable;
use Bitrix\Main\UI\PageNavigation;

class LibraryBooksList extends CBitrixComponent
{
    protected $books = array();
    protected $dbResult = null;
    protected $navigation = null;

    function __construct($component = null)
    {
        CModule::includeModule("makarov.library");
        parent::__construct($component);
    }

    function onPrepareComponentParams($arParams)
    {
        $arParams["PAGE_SIZE"] = (int) $arParams["PAGE_SIZE"] > 0 ? (int) $arParams["PAGE_SIZE"] : 20;

        return parent::onPrepareComponentParams($arParams);
    }

    function executeComponent()
    {
        $this->navigation = new PageNavigation("nav-books");
        $this->navigation->allowAllRecords(true)
            ->setPageSize($this->arParams["PAGE_SIZE"])
            ->initFromUri();

        $this->dbResult = BookTable::getList(array(
            "count_total" => true,
            "offset" => $this->navigation->getOffset(),
            "limit" => $this->navigation->getLimit(),
        ));
        $this->navigation->setRecordCount($this->dbResult->getCount());
        $this->books = $this->dbResult->fetchAll();

        $this->compareArResult();
        $this->includeComponentTemplate();
    }

    protected function compareArResult () {
        $this->arResult["NAVIGATION"] = $this->navigation;
        $this->arResult["DB_RESULT"] = $this->dbResult;
        $this->arResult["BOOKS"] = $this->books;
    }
}