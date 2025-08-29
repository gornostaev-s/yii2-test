<?php

use common\helpers\AppHelper;
use common\helpers\DateTimeHelper;
use common\models\Book;
use common\models\Channel;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii2mod\collection\Collection;

/* @var $this yii\web\View */
/* @var $model common\models\Book */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Книги', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id . ' | ' . $model->title;
\yii\web\YiiAsset::register($this);
?>
<div class="channel-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'id',
            ],
            'title',
            'description',
            'isbn',
            'year',
            [
                    'attribute' => 'image_url',
                'format' => 'raw',
                'value' => function (Book $book) {
                    return Html::img($book->image_url, ['style' => 'max-width: 200px; max-height: 200px;']);
                }
            ],
//            [
//                'attribute' => 'webmasterId',
//                'label' => 'ID Вебмастера',
//            ],
//            [
//                'attribute' => 'uid',
//                'label' => 'Уникальный Uid',
//            ],
//            [
//                'attribute' => 'deduplicatePeriod',
//                'label' => 'Период дедубликации',
//                'value' => static fn (Channel $model) => DateTimeHelper::formatSeconds($model->deduplicatePeriod)
//            ],
//            [
//                'attribute' => 'channelGroups',
//                'label' => 'Группы',
//                'value' => function (Channel $model) {
//                    return Collection::make($model->channelGroups)
//                        ->sortBy('id')
//                        ->pluck('description')
//                        ->implode(', ');
//                }
//            ],
//            AppHelper::getViewStatus(false),

        ],
    ]) ?>

</div>
