<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Авторы';
$this->params['breadcrumbs'][] = $this->title;
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
//        AppHelper::getEditableStatusColumn($searchModel, '/channel/update', ChannelForm::class),
//        AppHelper::getActionButton(),
//        AppHelper::getDeleteColumn('/channel/delete', ChannelForm::class),
    ],
]); ?>