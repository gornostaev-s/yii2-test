<?php

declare(strict_types=1);

namespace common\repositories;

use common\models\Author;
use yii\db\ActiveRecord;

class AuthorRepository extends BaseRepository
{
    /**
     * @var ActiveRecord
     */
    public static string $modelClass = Author::class;
}