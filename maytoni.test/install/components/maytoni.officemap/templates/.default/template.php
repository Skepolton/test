<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$APPLICATION->AddHeadString('<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&apikey=93d708f7-181c-497b-9410-7bc0d3145696" type="text/javascript"></script>');
?>

<div id="Maytoni_Map" style="width:100%;height:500px"></div>
<div id='Contact_info'>
    <div class="Contact_all-items">
        <div id='Contact_wrapper'></div>
    </div>
</div>
<script type="text/javascript">
    MaytoniMap.init({
        contacts:<?=CUtil::PhpToJSObject($arResult['CONTACTS'])?>
    });
</script>
