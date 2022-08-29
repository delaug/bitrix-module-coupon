<?php
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
Loc::loadMessages(__FILE__);

class coupon extends CModule
{
    public $MODULE_ID = "coupon";
	public $MODULE_VERSION;
	public $MODULE_VERSION_DATE;
	public $MODULE_NAME;
	public $MODULE_DESCRIPTION;
	public $MODULE_CSS;
	public $MODULE_GROUP_RIGHTS = "N";

    public function __construct()
    {
        $arModuleVersion = array();
        include __DIR__ . '/version.php';

        if (is_array($arModuleVersion) && array_key_exists('VERSION', $arModuleVersion)) {
            $this->MODULE_VERSION = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        }
		
        $this->MODULE_NAME = Loc::getMessage('COUPON_MODULE_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage('COUPON_MODULE_DESCRIPTION');
        $this->MODULE_GROUP_RIGHTS = 'N';
    }
	
    public function InstallDB()
    {
        if (Loader::includeModule($this->MODULE_ID)) {
            //
        }
    }
	
    public function UninstallDB()
    {
        if (Loader::includeModule($this->MODULE_ID)) {
            //
        }
    }

    function InstallFiles()
	{
		CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/local/modules/coupon/install/admin", $_SERVER["DOCUMENT_ROOT"]."/bitrix/admin", true, true);
        CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/local/modules/coupon/install/components", $_SERVER["DOCUMENT_ROOT"]."/bitrix/components", true, true);
		return true;
	}

	function UnInstallFiles()
	{
		DeleteDirFiles($_SERVER["DOCUMENT_ROOT"]."/local/modules/coupon/install/admin", $_SERVER["DOCUMENT_ROOT"]."/bitrix/admin");		
		return true;
	}

    public function doInstall()
    {
        global $APPLICATION;
        ModuleManager::registerModule($this->MODULE_ID);        
        $this->InstallDB();
        $this->InstallFiles();

        $APPLICATION->IncludeAdminFile("Установка модуля coupon", $_SERVER["DOCUMENT_ROOT"]."/local/modules/coupon/install/step.php");
    }
	
    public function doUninstall()
    {
        global $APPLICATION;
        $this->UninstallDB();
        $this->UnInstallFiles();
        ModuleManager::unRegisterModule($this->MODULE_ID);
        $APPLICATION->IncludeAdminFile("Деинсталляция модуля coupon", $_SERVER["DOCUMENT_ROOT"]."/local/modules/coupon/install/unstep.php");
    }
	
}