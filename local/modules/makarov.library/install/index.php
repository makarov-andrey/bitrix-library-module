<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use Makarov\Library\BookTable;
use Makarov\Library\AuthorTable;
use Makarov\Library\BookAuthorTable;
use Bitrix\Main\IO\Directory;

Loc::loadMessages(__FILE__);

if (class_exists('makarov_library')) {
    return;
}

class makarov_library extends CModule
{
    /** @var string */
    public $MODULE_ID;

    /** @var string */
    public $MODULE_VERSION;

    /** @var string */
    public $MODULE_VERSION_DATE;

    /** @var string */
    public $MODULE_NAME;

    /** @var string */
    public $MODULE_DESCRIPTION;

    /** @var string */
    public $MODULE_GROUP_RIGHTS;

    /** @var string */
    public $PARTNER_NAME;

    /** @var string */
    public $PARTNER_URI;

    public function __construct()
    {
        $arModuleVersion = array();
        include(__DIR__ . 'version.php');

        $this->MODULE_ID = 'makarov.library';
        $this->MODULE_VERSION = $arModuleVersion['VERSION'];
        $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        $this->MODULE_NAME = Loc::getMessage('MODULE_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage('MODULE_DESCRIPTION');
        $this->MODULE_GROUP_RIGHTS = 'N';
        $this->PARTNER_NAME = "";
        $this->PARTNER_URI = "";
    }

    public function doInstall()
    {
        ModuleManager::registerModule($this->MODULE_ID);
        $this->installDB();
        $this->installFiles();
    }

    public function doUninstall()
    {
        $this->uninstallDB();
        $this->unInstallFiles();
        ModuleManager::unRegisterModule($this->MODULE_ID);
    }

    public function installDB()
    {
        if (Loader::includeModule($this->MODULE_ID)) {
            BookTable::getEntity()->createDbTable();
            AuthorTable::getEntity()->createDbTable();
            BookAuthorTable::getEntity()->createDbTable();
        }
    }

    public function uninstallDB()
    {
        if (Loader::includeModule($this->MODULE_ID)) {
            $connection = Application::getInstance()->getConnection();
            $connection->dropTable(BookTable::getTableName());
            $connection->dropTable(AuthorTable::getTableName());
            $connection->dropTable(BookAuthorTable::getTableName());
        }
    }

    function installFiles()
    {
        CopyDirFiles(
            __DIR__ . '/admin',
            $_SERVER['DOCUMENT_ROOT']."/bitrix/admin"
        );
        CopyDirFiles(
            __DIR__ . '/components',
            $_SERVER['DOCUMENT_ROOT']."/local/components",
            true,
            true
        );
    }

    function unInstallFiles()
    {
        DeleteDirFiles(
            __DIR__ . '/admin',
            $_SERVER["DOCUMENT_ROOT"]."/bitrix/admin"
        );
        Directory::deleteDirectory($_SERVER['DOCUMENT_ROOT']."/local/components/makarov");
    }
}
