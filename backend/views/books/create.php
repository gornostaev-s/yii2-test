<?php

use common\models\Author;
use common\models\forms\BookForm;
use yii\helpers\Html;

/* @var yii\web\View $this */
/* @var BookForm $model */
/* @var Author[] $authors */

$this->title = 'Создать книгу';
$this->params['breadcrumbs'][] = ['label' => 'Книги', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id . ' | ' . $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Создать';

?>
<div class="books-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'authors' => $authors,
    ]) ?>

</div>
