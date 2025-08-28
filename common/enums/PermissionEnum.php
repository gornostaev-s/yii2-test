<?php

declare(strict_types=1);

namespace common\enums;

enum PermissionEnum: string
{
    case viewBook = 'viewBook';
    case createBook = 'createBook';
    case updateBook = 'updateBook';
    case deleteBook = 'deleteBook';

    case viewAuthor = 'viewAuthor';
    case createAuthor = 'createAuthor';
    case updateAuthor = 'updateAuthor';
    case deleteAuthor = 'deleteAuthor';

    case subscribeAuthor = 'subscribeAuthor';
}