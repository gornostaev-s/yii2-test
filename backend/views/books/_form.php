<?php

/**
 * @var \common\models\forms\BookForm $model
 * @var Author[] $authors
 */

use common\models\Author;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'id' => 'books-form',
    'options' => ['enctype' => 'multipart/form-data']
]); ?>

<?= $form->field($model, 'id')->hiddenInput()->label(false) ?>

<?= $form->field($model, 'title')->textInput() ?>

<?= $form->field($model, 'description')->textInput() ?>

<?= $form->field($model, 'isbn')->textInput() ?>

<?= $form->field($model, 'year')->textInput() ?>

<?= $form->field($model, 'author_ids')->widget(Select2::class, [
    'data' => array_column($authors, 'fio', 'id'),
    'options' => [
        'placeholder' => 'Выбрать авторов',
        'multiple' => true,
    ],
])->label('Авторы') ?>

<?= $form->field($model, 'image_url')->textInput() ?>

<?= $form->field($model, 'image_file')->fileInput() ?>

<?php if (!$model->id && $model->image_url): ?>
    <div class="form-group">
        <label>Текущая обложка</label><br>
        <?= Html::img($model->image_url, ['style' => 'max-width: 200px; max-height: 200px;']) ?>
    </div>
<?php endif; ?>

<br><br>
<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
<?php ActiveForm::end(); ?>
