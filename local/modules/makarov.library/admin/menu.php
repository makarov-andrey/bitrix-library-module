<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

$aMenu[] = array(
    array(
        'parent_menu' => 'global_menu_content',
        'sort' => 400,
        'text' => "Библиотека текст",
        'title' => "Библиотека заголовок",
        'url' => 'library_index.php',
        'items_id' => 'menu_references',
        'items' => array(
            array(
                'text' => "Трпр",
                'url' => 'library_index.php?param1=paramval&lang=' . LANGUAGE_ID,
                'more_url' => array('library_index.php?param1=paramval&lang='.LANGUAGE_ID),
                'title' => "Уруруру",
            ),
        ),
    ),
);
