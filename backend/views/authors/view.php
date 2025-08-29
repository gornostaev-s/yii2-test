<?php

use common\helpers\AppHelper;
use common\helpers\DateTimeHelper;
use common\models\Book;
use common\models\Channel;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii2mod\collection\Collection;

/* @var $this yii\web\View */
/* @var $model common\models\Author */

$this->title = $model->fio;
$this->params['breadcrumbs'][] = ['label' => 'Авторы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id . ' | ' . $model->fio;
\yii\web\YiiAsset::register($this);
?>
<div class="author-view">

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
            'first_name',
            'middle_name',
            'last_name',
        ],
    ]) ?>

</div>
