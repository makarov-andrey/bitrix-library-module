<?php

use Makarov\Library\AuthorTable;
use Bitrix\Main\UI\PageNavigation;
use Bitrix\Main\DB\Result as DBResult;

class LibraryAuthorsList extends CBitrixComponent
{
    protected $authors = array();

    /**
     * @var DBResult
     */
    protected $dbResult = null;

    /**
     * @var PageNavigation
     */
    protected $navigation = null;

    function __construct($component = null)
    {
        CModule::includeModule("makarov.library");
        parent::__construct($component);
    }

    function onPrepareComponentParams($arParams)
    {
        $arParams["PAGE_SIZE"] = (int)$arParams["PAGE_SIZE"] > 0 ? (int)$arParams["PAGE_SIZE"] : 20;
        if (isset($arParams["CUSTOM_NAVIGATION"]) && !($arParams["CUSTOM_NAVIGATION"] instanceof PageNavigation)) {
            unset($arParams["CUSTOM_NAVIGATION"]);
        }
        return parent::onPrepareComponentParams($arParams);
    }

    function executeComponent()
    {
        $this->navigation = $this->createNavigation();

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

    protected function createNavigation()
    {
        if (isset($this->arParams["CUSTOM_NAVIGATION"])) {
            return $this->arParams["CUSTOM_NAVIGATION"];
        }
        $navigation = new PageNavigation("authors-list-navigation");
        $navigation->allowAllRecords(true)
            ->setPageSize($this->arParams["PAGE_SIZE"])
            ->initFromUri();
        return $navigation;
    }

    protected function compareArResult()
    {
        $this->arResult["NAVIGATION"] = $this->navigation;
        $this->arResult["DB_RESULT"] = $this->dbResult;
        $this->arResult["AUTHORS"] = $this->authors;
    }
}