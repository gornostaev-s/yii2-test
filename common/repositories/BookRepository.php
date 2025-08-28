<?php

declare(strict_types=1);

namespace common\repositories;

use common\models\Book;

class BookRepository extends BaseRepository
{
    public static string $modelClass = Book::class;
}