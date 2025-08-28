<?php

declare(strict_types=1);

namespace common\repositories;

use Throwable;
use yii\db\ActiveRecord;
use yii\db\ActiveRecordInterface;
use yii\db\Exception;
use yii\db\StaleObjectException;

abstract class BaseRepository
{
    /**
     * @var ActiveRecord
     */
    public static string $modelClass;

    public function get(int $id): null|ActiveRecordInterface
    {
        return static::$modelClass::findOne($id);
    }

    public function findAll(): array
    {
        return static::$modelClass::find()->all();
    }

    /**
     * @param ActiveRecord $model
     * @return bool
     * @throws Exception
     */
    public function save(ActiveRecord $model): bool
    {
        return $model->save();
    }

    /**
     * @param int $id
     * @return bool|int
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function delete(int $id): bool|int
    {
        $model = static::$modelClass::findOne($id);

        return $model->delete();
    }
}