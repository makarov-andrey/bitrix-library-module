<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();
CModule::IncludeModule('makarov.library');

use Makarov\Library\AdminURL;


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
                'url' => AdminURL::BOOKS_LIST,
                'more_url' => array(
                    AdminURL::BOOK_ADD
                ),
                'title' => "Управление книгами библиотеки",
            ),
            array(
                'text' => 'Авторы',
                'url' => AdminURL::AUTHORS_LIST,
                'more_url' => array(
                    AdminURL::AUTHOR_ADD
                ),
                'title' => "Управление авторами библиотеки",
            ),
        ),
    ),
);

return $aMenu;