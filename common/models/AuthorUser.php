<?php

declare(strict_types=1);

namespace common\models;

use yii\db\ActiveRecord;

/**
 * @property int $author_id
 * @property int $user_id
 */
class AuthorUser extends ActiveRecord
{
    public function rules(): array
    {
        return [
            [['author_id', 'user_id'], 'required'],
            [['author_id', 'user_id'], 'integer'],
        ];
    }
}