<?php
defined('B_PROLOG_INCLUDED') || die;
namespace Maytoni;

use Bitrix\Main\Entity\DataManager;

class MaytoniTable extends DataManager
{
    public static function getTableName()
    {
        return 'maytoni_offices';
    }

    public static function getMap()
    {
        return array(
            'ID' => array(
                'data_type' => 'integer',
                'primary' => true,
                'autocomplete' => true,
             ),
            'NAME' => array(
                'data_type' => 'string',
             ),
            'PHONE' => array(
                'data_type' => 'string',
             ),
            'EMAIL' => array(
                'data_type' => 'string',
             ),
            'CITY' => array(
                'data_type' => 'string',
             ),
            'LON' => array(
                'data_type' => 'float',
             ),
            'LAT' => array(
                'data_type' => 'float',
             ),
        );
    }
}

class MyatoniIblock {
   public static function create_iblock()
   {
      \CModule::IncludeModule("iblock");
      
   //Добавим тип инфоблока
      $arFields = Array(
         'ID'=>'maytoni_content',
         'SECTIONS'=>'Y',
         'IN_RSS'=>'N',
         'SORT'=>100,
         'LANG'=>Array(
             'ru'=>Array(
                 'NAME'=>'Майтони контент',
                 'SECTION_NAME'=>'Разделы',
                 'ELEMENT_NAME'=>'Офисы'
                 )
             )
         );
     
     $obBlocktype = new \CIBlockType;
     
     $res = $obBlocktype->Add($arFields);
     
     if ($res > 0)
     {
        echo "&mdash; Тип инфоблока \"Майтони контент\" успешно создан<br />";
     }
     else
     {
        echo "&mdash; ошибка создания типа инфоблока \"Майтони контент\"<br />";
     }
   //Добавим инфоблок и свойства
      $ib = new \CIBlock;

      $IBLOCK_TYPE = "maytoni_content";
      $SITE_ID = "s1";         
    
      $arAccess = array(
         "2" => "R", 
         );

      $arFields = Array(
         "ACTIVE" => "Y",
         "NAME" => "Офисы",
         "CODE" => "offices",
         "IBLOCK_TYPE_ID" => $IBLOCK_TYPE,
         "SITE_ID" => $SITE_ID,
         "SORT" => "5",
         "GROUP_ID" => $arAccess, 
         "FIELDS" => array(
            "DETAIL_PICTURE" => array(
               "IS_REQUIRED" => "N", 
               "DEFAULT_VALUE" => array(
                  "SCALE" => "Y", 
                  "WIDTH" => "600", 
                  "HEIGHT" => "600",
                  "IGNORE_ERRORS" => "Y",
                  "METHOD" => "resample",
                  "COMPRESSION" => "95", 
               ),
            ),
            "PREVIEW_PICTURE" => array(
               "IS_REQUIRED" => "N",
               "DEFAULT_VALUE" => array(
                  "SCALE" => "Y",
                  "WIDTH" => "140",
                  "HEIGHT" => "140",
                  "IGNORE_ERRORS" => "Y",
                  "METHOD" => "resample",
                  "COMPRESSION" => "95",
                  "FROM_DETAIL" => "Y",
                  "DELETE_WITH_DETAIL" => "Y",
                  "UPDATE_WITH_DETAIL" => "Y",
               ),
            ),
            "SECTION_PICTURE" => array(
               "IS_REQUIRED" => "N",
               "DEFAULT_VALUE" => array(
                  "SCALE" => "Y",
                  "WIDTH" => "235",
                  "HEIGHT" => "235",
                  "IGNORE_ERRORS" => "Y",
                  "METHOD" => "resample",
                  "COMPRESSION" => "95",
                  "FROM_DETAIL" => "Y",
                  "DELETE_WITH_DETAIL" => "Y",
                  "UPDATE_WITH_DETAIL" => "Y",
               ),
            ),
            "CODE" => array(
               "IS_REQUIRED" => "N",
               "DEFAULT_VALUE" => array(
                  "UNIQUE" => "Y",
                  "TRANSLITERATION" => "Y",
                  "TRANS_LEN" => "30",
                  "TRANS_CASE" => "L",
                  "TRANS_SPACE" => "-",
                  "TRANS_OTHER" => "-",
                  "TRANS_EAT" => "Y",
                  "USE_GOOGLE" => "N",
                  ),
               ),
            "SECTION_CODE" => array(
               "IS_REQUIRED" => "N",
               "DEFAULT_VALUE" => array(
                  "UNIQUE" => "Y",
                  "TRANSLITERATION" => "Y",
                  "TRANS_LEN" => "30",
                  "TRANS_CASE" => "L",
                  "TRANS_SPACE" => "-",
                  "TRANS_OTHER" => "-",
                  "TRANS_EAT" => "Y",
                  "USE_GOOGLE" => "N",
                  ),
               ),
            "DETAIL_TEXT_TYPE" => array(
               "DEFAULT_VALUE" => "html",
               ),
            "SECTION_DESCRIPTION_TYPE" => array(
               "DEFAULT_VALUE" => "html",
               ),
            "IBLOCK_SECTION" => array(
               "IS_REQUIRED" => "N",
               ),            
            "LOG_SECTION_ADD" => array("IS_REQUIRED" => "Y"),
            "LOG_SECTION_EDIT" => array("IS_REQUIRED" => "Y"),
            "LOG_SECTION_DELETE" => array("IS_REQUIRED" => "Y"),
            "LOG_ELEMENT_ADD" => array("IS_REQUIRED" => "Y"),
            "LOG_ELEMENT_EDIT" => array("IS_REQUIRED" => "Y"),
            "LOG_ELEMENT_DELETE" => array("IS_REQUIRED" => "Y"),
         ),
         
         "LIST_PAGE_URL" => "#SITE_DIR#/contents/offices",
         "SECTION_PAGE_URL" => "#SITE_DIR#/contents/offices/#SECTION_CODE#/",
         "DETAIL_PAGE_URL" => "#SITE_DIR#/contents/offices/#SECTION_CODE#/#ELEMENT_CODE#/",         

         "INDEX_SECTION" => "Y",
         "INDEX_ELEMENT" => "Y",

         "VERSION" => 1,

         "ELEMENT_NAME" => "Офис",
         "ELEMENTS_NAME" => "Офисы",
         "ELEMENT_ADD" => "Добавить офис",
         "ELEMENT_EDIT" => "Изменить офис",
         "ELEMENT_DELETE" => "Удалить офис",
         "SECTION_NAME" => "Категории",
         "SECTIONS_NAME" => "Категория",
         "SECTION_ADD" => "Добавить категорию",
         "SECTION_EDIT" => "Изменить категорию",
         "SECTION_DELETE" => "Удалить категорию",

         "SECTION_PROPERTY" => "N",
      );

      $ID = $ib->Add($arFields);
      if ($ID > 0)
      {
         echo "&mdash; инфоблок \"Офисы\" успешно создан<br />";
      }
      else
      {
         echo "&mdash; ошибка создания инфоблока \"Офисы\"<br />";
         return false;
      }

      $dbProperties = \CIBlockProperty::GetList(array(), array("IBLOCK_ID"=>$ID));
      if ($dbProperties->SelectedRowsCount() <= 0)
      {
         $ibp = new \CIBlockProperty;

         $arFields = Array(
            "NAME" => "Телефон",
            "ACTIVE" => "Y",
            "SORT" => 100,
            "CODE" => "PHONE",
            "PROPERTY_TYPE" => "S",
            "ROW_COUNT" => 1,
            "COL_COUNT" => 30,
            "IBLOCK_ID" => $ID,
            "HINT" => "Телефон",
           );
         $propId = $ibp->Add($arFields);
         if ($propId > 0)
         {
            $arFields["ID"] = $propId;
            $arCommonProps[$arFields["CODE"]] = $arFields;
            echo "&mdash; Добавлено свойство ".$arFields["NAME"]."<br />";
         }
         else
            echo "&mdash; Ошибка добавления свойства ".$arFields["NAME"]."<br />";

         $arFields = Array(
            "NAME" => "E-mail",
            "ACTIVE" => "Y",
            "SORT" => 100,
            "CODE" => "EMAIL",
            "PROPERTY_TYPE" => "S",
            "ROW_COUNT" => 1,
            "COL_COUNT" => 30,
            "IBLOCK_ID" => $ID,
            "HINT" => "EMAIL",
           );
         $propId = $ibp->Add($arFields);
         if ($propId > 0)
         {
            $arFields["ID"] = $propId;
            $arCommonProps[$arFields["CODE"]] = $arFields;
            echo "&mdash; Добавлено свойство ".$arFields["NAME"]."<br />";
         }
         else
            echo "&mdash; Ошибка добавления свойства ".$arFields["NAME"]."<br />";

         $arFields = Array(
            "NAME" => "Долгота",
            "ACTIVE" => "Y",
            "SORT" => 100,
            "CODE" => "LON",
            "PROPERTY_TYPE" => "S",
            "ROW_COUNT" => 1,
            "COL_COUNT" => 30,
            "IBLOCK_ID" => $ID,
            "HINT" => "Долгота",
           );
         $propId = $ibp->Add($arFields);
         if ($propId > 0)
         {
            $arFields["ID"] = $propId;
            $arCommonProps[$arFields["CODE"]] = $arFields;
            echo "&mdash; Добавлено свойство ".$arFields["NAME"]."<br />";
         }
         else
            echo "&mdash; Ошибка добавления свойства ".$arFields["NAME"]."<br />";

         $arFields = Array(
            "NAME" => "Широта",
            "ACTIVE" => "Y",
            "SORT" => 100,
            "CODE" => "LAT",
            "PROPERTY_TYPE" => "S",
            "ROW_COUNT" => 1,
            "COL_COUNT" => 30,
            "IBLOCK_ID" => $ID,
            "HINT" => "Широта",
           );
         $propId = $ibp->Add($arFields);
         if ($propId > 0)
         {
            $arFields["ID"] = $propId;
            $arCommonProps[$arFields["CODE"]] = $arFields;
            echo "&mdash; Добавлено свойство ".$arFields["NAME"]."<br />";
         }
         else
            echo "&mdash; Ошибка добавления свойства ".$arFields["NAME"]."<br />";
         $arFields = Array(
            "NAME" => "Город",
            "ACTIVE" => "Y",
            "SORT" => 100,
            "CODE" => "CITY",
            "PROPERTY_TYPE" => "S",
            "ROW_COUNT" => 1,
            "COL_COUNT" => 30,
            "IBLOCK_ID" => $ID,
            "HINT" => "Город",
           );
         $propId = $ibp->Add($arFields);
         if ($propId > 0)
         {
            $arFields["ID"] = $propId;
            $arCommonProps[$arFields["CODE"]] = $arFields;
            echo "&mdash; Добавлено свойство ".$arFields["NAME"]."<br />";
         }
         else
            echo "&mdash; Ошибка добавления свойства ".$arFields["NAME"]."<br />";
      }
      else
         echo "&mdash; Для данного инфоблока уже существуют свойства<br />";      

      return $ID;
   }

   public static function fillDemoData($ID){
      \CModule::IncludeModule("iblock");
      $trParams = array("replace_space"=>"-","replace_other"=>"-");
        if (($handle = fopen($_SERVER["DOCUMENT_ROOT"]."/offices.csv", "r")) !== FALSE) { 
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            $rows[] = $data;
            }   
            foreach ($rows as $key => $value) {
                if ($key == 0) continue;
                
                $arFields = array(
                    "ACTIVE" => "Y", 
                    "IBLOCK_ID" => $ID,
                    "NAME" => $value[0],
                    "CODE" => \Cutil::translit($value[0],"ru",$trParams),
                    "DETAIL_TEXT" => "",
                    "PROPERTY_VALUES" => array(
                    "PHONE" => $value[1],
                    "EMAIL" => $value[2],
                    "LON" => $value[3],
                    "LAT" => $value[4],
                    "CITY" => $value[5],
                    )
                );
                $oElement = new \CIBlockElement();
                $idElement = $oElement->Add($arFields, false, false, true);
            } 
            fclose($handle);
        }
   }

}

?>