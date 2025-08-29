<?php

declare(strict_types=1);

namespace common\repositories;

use yii\db\ActiveRecord;
use yii\db\ActiveRecordInterface;
use yii\db\Exception;

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
     * @param ActiveRecordInterface $model
     * @return bool|int
     */
    public function delete(ActiveRecordInterface $model): bool|int
    {
        return $model->delete();
    }
}