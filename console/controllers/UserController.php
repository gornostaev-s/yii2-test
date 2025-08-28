<?php

declare(strict_types=1);

namespace console\controllers;

use common\models\User;
use common\repositories\UserRepository;
use Exception;
use Yii;
use yii\console\Controller;
use yii\rbac\ManagerInterface;
use yii\rbac\Role;

class UserController extends Controller
{
    public function __construct(
        $id,
        $module,
        private readonly UserRepository $userRepository,
        private readonly ManagerInterface $authManager,
        $config = []
    ) {
        parent::__construct($id, $module, $config);
    }

    /**
     * @throws \yii\base\Exception
     */
    public function actionCreate(): void
    {
        $userName = $this->prompt('Введите username: ');
        $email = $this->prompt('Введите email: ');
        $password = $this->prompt('Введите пароль: ');
        if ($this->userRepository->getByUserName($userName)) {
            $this->stdout('Пользователь уже создан' . PHP_EOL);
            return;
        }

        $user = new User();
        $user->auth_key = Yii::$app->security->generateRandomString();
        $user->password_hash = Yii::$app->security->generatePasswordHash(trim($password));
        $user->username = trim($userName);
        $user->email = trim($email);
        $user->status = User::STATUS_ACTIVE;

        if (!$user->validate()) {
            $errors = $user->getFirstErrors();
            $error = array_shift($errors);
            $this->stdout('Ошибка: ' . ($error ?: 'Неизвестная ошибка') . PHP_EOL);
            return;
        }

        $user->save(false);
        $this->stdout('Пользователь создан: ' . $user->id . PHP_EOL);
    }

    /**
     * @throws Exception
     */
    public function actionAssignRole(): void
    {
        $userName = $this->prompt('Введите username');
        $roleName = $this->prompt('Введите rolename');
        $user = $this->userRepository->getByUserName($userName);

        if (!$user) {
            $this->stdout('Пользователь не найден' . PHP_EOL);
            return;
        }

        $role = $this->authManager->getRole($roleName);

        if (!$role) {
            $this->stdout('Роль "' . $roleName . '" не найдена' . PHP_EOL);
            return;
        }

        $this->assignRole($role, $user);
    }

    /**
     * @throws Exception
     */
    private function assignRole(Role $role, User $user): void
    {
        if ($this->authManager->getAssignment($role->name, $user->id)) {
            $this->stdout('Роль "' . $role->name . '" уже назначена' . PHP_EOL);
            return;
        }

        $this->authManager->assign($role, $user->id);
        $this->stdout('Роль "' . $role->name . '" назначена' . PHP_EOL);
    }
}