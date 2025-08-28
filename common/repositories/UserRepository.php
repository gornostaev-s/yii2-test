<?php

declare(strict_types=1);

namespace common\repositories;

use common\dictionaries\users\UserStatusDictionary;
use common\models\User;

class UserRepository
{
    public function getByUserName(string $userName): ?User
    {
        /** @var User|null $user */
        $user = User::findOne([
            'username' => $userName,
        ]);

        return $user;
    }
}
