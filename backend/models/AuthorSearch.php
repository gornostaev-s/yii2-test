<?php

declare(strict_types=1);

namespace backend\models;

use common\models\Author;
use common\models\Book;
use yii\data\ActiveDataProvider;

class AuthorSearch extends Book
{
    public static function tableName(): string
    {
        return '{{%book}}';
    }

    public function rules(): array
    {
        return [
            [['year'], 'integer'],
            [['description', 'image_url', 'isbn', 'title'], 'string'],
        ];
    }

    public function search($params): ActiveDataProvider
    {
        $query = Author::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_ASC
                ]
            ]
        ]);

        $this->load($params);
        $dataProvider->getPagination()->setPageSize(500);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['year' => $this->year]);

        return $dataProvider;
    }
}