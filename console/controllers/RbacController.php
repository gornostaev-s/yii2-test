<?php

declare(strict_types=1);

namespace console\controllers;

use common\services\RbacService;
use Exception;
use yii\console\Controller;

class RbacController extends Controller
{
    public function __construct(
        $id,
        $module,
        private readonly RbacService $rbacService,
        $config = []
    ) {
        parent::__construct($id, $module, $config);
    }

    /**
     * @return void
     * @throws Exception
     */
    public function actionInit(): void
    {
        $this->rbacService->initPermissions();
        $this->rbacService->initRoles();
        $this->rbacService->assignRoles();
    }
}
