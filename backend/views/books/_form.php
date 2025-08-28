<?php

/**
 * @var \common\models\forms\BookForm $model
 * @var Author[] $authors
 */

use common\models\Author;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii2mod\collection\Collection;

$form = ActiveForm::begin(['id' => 'books-form']); ?>

<?= $form->field($model, 'id')->hiddenInput()->label(false) ?>

<?= $form->field($model, 'title')->textInput() ?>

<?= $form->field($model, 'description')->textInput() ?>

<?= $form->field($model, 'isbn')->textInput() ?>

<?= $form->field($model, 'year')->textInput() ?>

<?= $form->field($model, 'image_url')->textInput() ?>

<?= $form->field($model, 'author_ids')->widget(Select2::class, [
    'data' => array_column($authors, 'fio', 'id'),
    'options' => [
        'placeholder' => 'Выбрать авторов',
        'multiple' => true,
    ],
])->label('Авторы') ?>
<br><br>
<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
<?php ActiveForm::end(); ?>
