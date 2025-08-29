<?php

declare(strict_types=1);

namespace backend\controllers;

use backend\models\ReportSearch;
use common\models\Author;
use yii\web\Controller;

class ReportController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new ReportSearch();
        $dataProvider = $searchModel->search([]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}