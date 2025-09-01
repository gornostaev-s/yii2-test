<?php

use common\models\Author;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$user = Yii::$app->user->identity;
$this->title = 'Авторы';
$this->params['breadcrumbs'][] = $this->title;
$actions = [
    'class' => ActionColumn::class, // Класс колонки действий
    'header' => 'Действия', // Заголовок колонки
    'template' => '{view} {update} {delete} {subscribe} {unsubscribe}', // Кнопки, которые будут отображаться
    'buttons' => [
        'subscribe' => function ($url, Author $model, $key) use ($user) {
            // Здесь вы можете настроить вид кнопки "Просмотр"
//            return '<a href="' . Url::to(['/authors/subscribe', 'id' => $model->id]) . '" data-pjax="0">✔</a>';
            return '<a title="Подписаться" style="text-decoration: unset" href="' . Url::to(['/authors/subscribe', 'id' => $model->id]) . '" data-pjax="0">✅</a>';
        },
        'unsubscribe' => function ($url, Author $model, $key) use ($user) {
            // Здесь вы можете настроить вид кнопки "Просмотр"
//            return '<a href="' . Url::to(['/authors/subscribe', 'id' => $model->id]) . '" data-pjax="0">✔</a>';
            return '<a title="Отписаться" style="text-decoration: unset" href="' . Url::to(['/authors/unsubscribe', 'id' => $model->id]) . '" data-pjax="0">❌</a>';
        },
    ],
    'urlCreator' => function ($action, $model, $key, $index, $column) {
        // Функция для создания URL для каждого действия
        return Yii::$app->urlManager->createUrl([$action, 'id' => $model->id]);
    },
];
?>

    <p><?= Html::a('Создать автора', ['create'], ['class' => 'btn btn-success']) ?></p>

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
        'first_name',
        'middle_name',
        'last_name',
        $actions,
    ],
]); ?>