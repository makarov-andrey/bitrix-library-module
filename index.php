<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Главная');

Bitrix\Main\Loader::includeModule("makarov.library");

$result = \Makarov\Library\BookTable::add(array(
    'TITLE' => 'Книга 1',
));

if ($result->isSuccess())
{
    echo $result->getId();
}

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
