<?php

declare(strict_types=1);

namespace common\models\forms;

use yii\base\Model;

class AuthorForm extends Model
{
    public ?int $id = null;
    public ?string $first_name = null;
    public ?string $last_name = null;
    public ?string $middle_name = null;

    public function rules(): array
    {
        return [
            [['first_name', 'last_name', 'middle_name'], 'required']
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
}