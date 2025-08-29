<?php

use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Книги';
$this->params['breadcrumbs'][] = $this->title;
$actions = [
    'class' => ActionColumn::class, // Класс колонки действий
    'header' => 'Действия', // Заголовок колонки
    'template' => Yii::$app->user->can('user') ? '{view} {update} {delete}' : '{view}', // Кнопки, которые будут отображаться
];
?>

    <p><?= Html::a('Создать книгу', ['create'], ['class' => 'btn btn-success']) ?></p>

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
        [
            'attribute' => 'title',
            'label' => 'Название',
            'format' => 'raw',
            'value' => function ($model) {
                return Html::a($model->title, ['books/update', 'id' => $model->id]);
            }
        ],
        $actions
    ],
]); ?>