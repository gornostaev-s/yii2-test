<?php

declare(strict_types=1);

namespace common\models;

use yii\db\ActiveRecord;

/**
 * @property int $book_id
 * @property int $author_id
 */
class BookAuthor extends ActiveRecord
{
    public function rules(): array
    {
        return [
            [['book_id', 'author_id'], 'required'],
            [['book_id', 'author_id'], 'integer'],
        ];
    }
}