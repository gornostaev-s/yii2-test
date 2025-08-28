<?php

declare(strict_types=1);

namespace common\enums;

enum RoleEnum: string
{
    case guest = 'guest';
    case user = 'user';

    /**
     * @param string $roleName
     * @return string[]
     */
    public static function getRoleAssignmentMap(string $roleName): array
    {
        return match($roleName) {
            self::guest->value => [
                PermissionEnum::viewBook->value,
                PermissionEnum::subscribeAuthor->value,
            ],
            self::user->value => [
                PermissionEnum::createBook->value,
                PermissionEnum::updateBook->value,
                PermissionEnum::deleteBook->value,
                PermissionEnum::viewBook->value,
                PermissionEnum::createAuthor->value,
                PermissionEnum::updateAuthor->value,
                PermissionEnum::deleteAuthor->value,
                PermissionEnum::viewAuthor->value,
                PermissionEnum::subscribeAuthor->value,
            ],
        };
    }
}