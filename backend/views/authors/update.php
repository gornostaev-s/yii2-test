<?php

use common\models\forms\AuthorForm;
use common\models\forms\BookForm;
use yii\helpers\Html;

/* @var yii\web\View $this */
/* @var AuthorForm $model */

$this->title = 'Обновить автора';
$this->params['breadcrumbs'][] = ['label' => 'Авторы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id . ' | ' . $model->fio, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="books-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
