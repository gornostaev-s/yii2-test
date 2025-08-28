<?php

declare(strict_types=1);

namespace common\services;

use common\enums\RoleEnum;
use common\enums\PermissionEnum;
use Exception;
use Yii;
use yii\rbac\Permission;
use yii\rbac\Role;

class RbacService
{
    /**
     * @return void
     * @throws \yii\base\Exception
     */
    public function assignRoles(): void
    {
        foreach (RoleEnum::cases() as $case) {
            $role = new Role(['name' => $case->value]);
            $this->reassignPermissionsForRole($role, RoleEnum::getRoleAssignmentMap($case->value));
        }
    }

    /**
     * @return void
     * @throws Exception
     */
    public function initPermissions(): void
    {
        foreach (PermissionEnum::cases() as $case) {
            $this->addPermission($case->value);
        }
    }
    /**
     * @return void
     * @throws Exception
     */
    public function initRoles(): void
    {
        foreach (RoleEnum::cases() as $case) {
            $this->addRole($case->value);
        }
    }

    /**
     * @throws Exception
     */
    public function addPermission(string $permissionName): bool
    {
        if ($this->getPermission($permissionName)) {
            return true;
        }

        $permission = $this->createPermission($permissionName);
        return Yii::$app->authManager->add($permission);
    }

    public function getPermission(string $permissionName): ?Permission
    {
        return Yii::$app->authManager->getPermission($permissionName);
    }

    public function createPermission(string $permissionName): Permission
    {
        return Yii::$app->authManager->createPermission($permissionName);
    }

    /**
     * @throws Exception
     */
    public function addRole(string $roleName): bool
    {
        if ($this->getRole($roleName)) {
            return true;
        }
        $role = $this->createRole($roleName);

        return Yii::$app->authManager->add($role);
    }

    public function getRole(string $roleName): ?Role
    {
        return Yii::$app->authManager->getRole($roleName);
    }

    public function createRole(string $roleName): Role
    {
        return Yii::$app->authManager->createRole($roleName);
    }

    /**
     * @param string[] $permissions
     * @throws \yii\base\Exception
     */
    private function reassignPermissionsForRole(Role $role, array $permissions): void
    {
        Yii::$app->authManager->removeChildren($role);

        foreach ($permissions as $permissionName) {
            $permission = $this->getPermission($permissionName);

            if ($permission === null) {
                continue;
            }

            Yii::$app->authManager->addChild($role, $permission);
        }
    }
}