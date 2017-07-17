<?php

use Makarov\Library\AuthorTable;
use Bitrix\Main\UI\PageNavigation;

class LibraryAuthorsList extends CBitrixComponent
{
    protected $authors = array();
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
        $this->navigation = new PageNavigation("nav-authors");
        $this->navigation->allowAllRecords(true)
            ->setPageSize($this->arParams["PAGE_SIZE"])
            ->initFromUri();

        $this->dbResult = AuthorTable::getList(array(
            "count_total" => true,
            "offset" => $this->navigation->getOffset(),
            "limit" => $this->navigation->getLimit(),
        ));
        $this->navigation->setRecordCount($this->dbResult->getCount());
        $this->authors = $this->dbResult->fetchAll();

        $this->compareArResult();
        $this->includeComponentTemplate();
    }

    protected function compareArResult () {
        $this->arResult["NAVIGATION"] = $this->navigation;
        $this->arResult["DB_RESULT"] = $this->dbResult;
        $this->arResult["AUTHORS"] = $this->authors;
    }
}