<?php

declare(strict_types=1);

namespace common\repositories;

use common\models\AuthorUser;

class AuthorUserRepository extends BaseRepository
{
    /**
     * @param int $userId
     * @param int $authorId
     * @return AuthorUser|null
     */
    public function findByUserIdAndAuthorId(int $userId, int $authorId): ?AuthorUser
    {
        return AuthorUser::findOne([
            'user_id' => $userId,
            'author_id' => $authorId,
        ]);
    }
}