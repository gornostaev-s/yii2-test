<?php

declare(strict_types=1);

namespace common\models;

class Report extends Author
{
    public static function tableName(): string
    {
        return '{{%author}}';
    }

    public int $books_count;

    public function rules(): array
    {
        return array_merge(parent::rules(), [['books_count'], 'integer']);
    }

    public function attributeLabels(): array
    {
        return [
            'fio' => 'ФИО',
            'books_count' => 'Количество книг',
        ];
    }
}