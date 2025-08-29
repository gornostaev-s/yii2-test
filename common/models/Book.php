<?php

declare(strict_types=1);

namespace common\models;

use yii\base\InvalidConfigException;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $isbn
 * @property int $year
 * @property string $image_url
 *
 * Related
 *
 * @property Author[] $authors
 */
class Book extends ActiveRecord
{
    public function rules(): array
    {
        return [
            [['title', 'isbn', 'year'], 'required'],
            [['description', 'image_url'], 'string'],
        ];
    }

    /**
     * @throws InvalidConfigException
     */
    public function getAuthors(): ActiveQuery
    {
        return $this->hasMany(Author::class, ['id' => 'author_id'])
            ->viaTable(BookAuthor::tableName(), ['book_id' => 'id']);
    }

    public function attributeLabels(): array
    {
        return [
            'title' => 'Название',
            'description' => 'Описание',
            'isbn' => 'ISBN',
            'year' => 'Год выпуска',
            'image_url' => 'Обложка',
        ];
    }
}
