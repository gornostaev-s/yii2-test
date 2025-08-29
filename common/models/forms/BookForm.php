<?php

declare(strict_types=1);

namespace common\models\forms;

use yii\base\Model;
use yii\web\UploadedFile;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $isbn
 * @property int $year
 * @property string $image_url
 */
class BookForm extends Model
{
    public ?int $id = null;
    public ?string $title = null;
    public ?string $description = null;
    public ?string $isbn = null;
    public ?string $year = null;
    public ?string $image_url = null;
    public ?array $author_ids = null;
    public ?string $image_file = null;

    public function rules(): array
    {
        return [
            [['title', 'isbn', 'year'], 'required'],
            [['description', 'image_url'], 'string'],
            [['author_ids'], 'safe'],
            [['image_file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
            [['year'], 'integer'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'title' => 'Название',
            'description' => 'Описание',
            'isbn' => 'ISBN',
            'year' => 'Год выпуска',
            'image_url' => 'Ссылка на обложку',
            'image_file' => 'Изображение обложки',
        ];
    }
}