<?php

declare(strict_types=1);

namespace backend\models;

use common\models\Author;
use common\models\Report;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class ReportSearch extends Model
{
    const REPORT_YEAR = 2025;

    public function search(array $params)
    {
        $query = Report::find()
            ->select(['author.*', 'COUNT(b.id) as books_count'])
            ->joinWith('books b')
            ->andWhere(['b.year' => self::REPORT_YEAR])
            ->groupBy('author.id')
            ->orderBy(['books_count' => SORT_DESC])
            ->limit(10);

        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }
}