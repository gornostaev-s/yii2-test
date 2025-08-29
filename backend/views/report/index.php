<?php

use backend\models\ReportSearch;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Авторы';
$this->params['breadcrumbs'][] = $this->title;
$actions = [
    'class' => ActionColumn::class, // Класс колонки действий
    'header' => 'Действия', // Заголовок колонки
    'template' => '{view} {update} {delete}', // Кнопки, которые будут отображаться
];
?>

<h1>Топ авторов за <?= ReportSearch::REPORT_YEAR?> год</h1>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        [
            'attribute' => 'id',
            'headerOptions' => ['style' => 'text-align: center;'],
            'contentOptions' => ['style' => 'text-align: center;'],
            'options' => ['style' => 'width: 5%'],
        ],
        'fio',
        'books_count'
    ],
]); ?>