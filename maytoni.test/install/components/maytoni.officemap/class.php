<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader;
use \Bitrix\Main\Data\Cache;
use Maytoni\MaytoniTable;

class MaytoniOfficeMap extends CBitrixComponent
{

	/**
	 * @param array $params
	 * @return array
	 */
	public function onPrepareComponentParams($params)
	{
		$params = parent::onPrepareComponentParams($params);

		return $params;
	}

	/**
	 * @return array
	 */
	protected function getContacts()
	{ 
		Loader::includeModule('maytoni.test');
/* 		$cache = Cache::createInstance(); 
		if ($cache->initCache(86400, "MaytoniTableContacts")) { 
			$result = $cache->getVars();
		}
		elseif ($cache->startDataCache()) {
			$query = MaytoniTable::query()
			->addSelect("*")
			->exec();
			$result = $query->fetchAll();		
			$cache->endDataCache($result); 
		} */

		$cache = Cache::createInstance(); 
		if ($cache->initCache(86400, "MaytoniTableContacts")) { 
			$result = $cache->getVars();
		}
		elseif ($cache->startDataCache()) {
			$iblock = COption::GetOptionString("maytoni.test", "iblock_offices", "");
			$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_PHONE","PROPERTY_EMAIL","PROPERTY_CITY","PROPERTY_LAT","PROPERTY_LON");//IBLOCK_ID и ID обязательно должны быть указаны, см. описание arSelectFields выше
			$arFilter = Array("IBLOCK_ID"=>IntVal($iblock), "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
			$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
			while($ob = $res->Fetch()){
				$result[] = $ob;	
			 } 
			$cache->endDataCache($result); 
		} 
		return $result;
	}

	/**
	 * void
	 */
	public function executeComponent()
	{
		$this->arResult["CONTACTS"] = $this->getContacts();
		$this->includeComponentTemplate();
	}

}