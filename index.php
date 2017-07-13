<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Главная');

Bitrix\Main\Loader::includeModule("makarov.library");

\Makarov\Library\BookTable::hw();

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>