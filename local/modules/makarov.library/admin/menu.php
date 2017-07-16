<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();



$aMenu = array(
    array(
        'parent_menu' => 'global_menu_content',
        'sort' => 400,
        'text' => "Библиотека",
        'title' => "Управление данными модуля Библиотека",
        'items_id' => 'menu_library',
        'items' => array(
            array(
                'text' => 'Книги',
                'url' => 'library_books.php',
                'title' => "Управление книгами библиотеки",
            ),
            array(
                'text' => 'Авторы',
                'url' => 'library_authors.php',
                'title' => "Управление авторами библиотеки",
            ),
        ),
    ),
);

return $aMenu;