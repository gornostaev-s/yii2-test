<?php

use common\models\forms\BookForm;
use yii\helpers\Html;

/* @var yii\web\View $this */
/* @var BookForm $model */

$this->title = 'Создать автора';
$this->params['breadcrumbs'][] = ['label' => 'Авторы', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Создать';

?>
<div class="books-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
