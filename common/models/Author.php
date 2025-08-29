<?php

declare(strict_types=1);

namespace common\models;

use yii\base\InvalidConfigException;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $middle_name
 * @property string $fio
 *
 * Related
 *
 * @property Book[] $books
 */
class Author extends ActiveRecord
{
    public function rules(): array
    {
        return [
            [['first_name', 'last_name', 'middle_name'], 'required'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'middle_name' => 'Отчество',
        ];
    }

    public function getFio(): string
    {
        return "$this->last_name $this->first_name $this->middle_name";
    }

    /**
     * @return ActiveQuery
     * @throws InvalidConfigException
     */
    public function getBooks(): ActiveQuery
    {
        return $this->hasMany(Book::class, ['id' => 'book_id'])
            ->viaTable(BookAuthor::tableName(), ['author_id' => 'id']);
    }
}