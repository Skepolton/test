<?php
defined('B_PROLOG_INCLUDED') || die;

use Bitrix\Main\Application;
use Bitrix\Main\Config\Option;
use Bitrix\Main\EventManager;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use Maytoni\MyatoniIblock;
class maytoni_test extends CModule
{
    const MODULE_ID = 'maytoni.test';
    var $MODULE_ID = self::MODULE_ID;
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $strError = '';

    function __construct()
    {
        $arModuleVersion = array();
        include(dirname(__FILE__) . '/version.php');
        $this->MODULE_VERSION = '1.0';
        $this->MODULE_VERSION_DATE = '29.03.2023';

        $this->MODULE_NAME = "Тестовое задание Maytoni";
        $this->MODULE_DESCRIPTION = "";

        $this->PARTNER_NAME = "Александр Ларкин";
        $this->PARTNER_URI = "https://larkin.pro";
    }

    function DoInstall()
    {
        ModuleManager::registerModule(self::MODULE_ID);

        $this->InstallDB();
        $this->InstallFiles();
        $this->InstallEvents();
    }

    function DoUninstall()
    {
        $this->UnInstallEvents();
        $this->UnInstallFiles();
        $this->UnInstallDB();

        ModuleManager::unRegisterModule(self::MODULE_ID);
    }

    function InstallDB()
    {
        Loader::includeModule('maytoni.test');

/*         $db = Application::getConnection();

        $tableEntity = MaytoniTable::getEntity();
        if (!$db->isTableExists($tableEntity->getDBTableName())) {
            $tableEntity->createDbTable();
        }

        if (($handle = fopen($_SERVER["DOCUMENT_ROOT"]."/offices.csv", "r")) !== FALSE) { 
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            $rows[] = $data;
            }   
            foreach ($rows as $key => $value) {
                if ($key == 0) continue;
                MaytoniTable::add([
                "NAME" => $value[0],
                "PHONE" => $value[1],
                "EMAIL" => $value[2],
                "CITY" => $value[5],
                "LON" => $value[3],
                "LAT" => $value[4],
                ]); 
            } 
            fclose($handle);
        } */
        $IblockID = MyatoniIblock::create_iblock();
        MyatoniIblock::fillDemoData($IblockID);
        \COption::SetOptionString("maytoni.test","iblock_offices",$IblockID);
    }

    function UnInstallDB()
    {
        global $DB;
        $this->strError = false;
        $this->strError = $DB->Query("DROP TABLE IF EXISTS `maytoni_offices`");
        if (!$this->strError) {
            return true;
        } else {
            return $this->strError;
        }
    }

    function InstallEvents()
    {

    }

    function UnInstallEvents()
    {

    }

    function InstallFiles()
    {
        $documentRoot = Application::getDocumentRoot();

        CopyDirFiles(
            __DIR__ . '/components',
            $documentRoot . '/local/components',
            true,
            true
        );

    }

    function UnInstallFiles()
    {

    }
}