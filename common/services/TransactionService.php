<?php

namespace common\services;

use Throwable;
use Yii;
use yii\db\Exception;

class TransactionService
{
    /**
     * @param callable $function
     *
     * @return mixed
     * @throws Throwable
     * @throws Exception
     */
    public function wrap(callable $function): mixed
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $result = $function();
            $transaction->commit();

            return $result;
        } catch (Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }
    }
}
