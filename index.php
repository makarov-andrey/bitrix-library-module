<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Главная');

$APPLICATION->IncludeComponent("makarov:library.books.list", "admin");

/*Bitrix\Main\Loader::includeModule("makarov.library");

function checkAddResult (\Bitrix\Main\Entity\AddResult $result) {
    if (!$result->isSuccess())
    {
        echo "Что-то пошло не так.";
        echo "<pre>";
        print_r($result);
        echo "</pre>";
        die();
    }
}

$booksAmount = 5;
$authorsAmount = 3;

for ($i = 1; $i <= $booksAmount; $i++) {
    $result = \Makarov\Library\BookTable::add(array(
        'TITLE' => 'Книга ' . $i,
    ));
    checkAddResult($result);
}

for ($i = 1; $i <= $authorsAmount; $i++) {
    $result = \Makarov\Library\AuthorTable::add(array(
        'NAME' => 'Автор ' . $i,
    ));
    checkAddResult($result);
}

for ($book = 1; $book <= $booksAmount; $book++) {
    $authorsIds = range(1, $authorsAmount);
    shuffle($authorsIds);

    for ($author = 1; $author <= rand(1, $authorsAmount); $author++) {
        $result = \Makarov\Library\BookAuthorTable::add(array(
            'BOOK_ID' => $book,
            'AUTHOR_ID' => $authorsIds[$author]
        ));
        checkAddResult($result);
    }
}

echo "OK";*/

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
