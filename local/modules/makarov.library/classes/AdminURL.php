<?php

namespace Makarov\Library;

class AdminURL
{
    const LIBRARY_ADMIN_URL_BOOKS = ADMIN_URL . '/library_books.php';
    const LIBRARY_ADMIN_URL_BOOK_EDIT = ADMIN_URL . '/library_book_edit.php';
    const LIBRARY_ADMIN_URL_AUTHORS = ADMIN_URL . '/library_authors.php';
    const LIBRARY_ADMIN_URL_AUTHOR_EDIT = ADMIN_URL . '/library_author_edit.php';

    public static function getBookEditURL ($bookID)
    {
        return static::LIBRARY_ADMIN_URL_BOOK_EDIT . '?id=' . $bookID;
    }

    public static function getAuthorEditURL ($authorID)
    {
        return static::LIBRARY_ADMIN_URL_BOOK_EDIT . '?id=' . $authorID;
    }
}