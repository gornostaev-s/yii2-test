<?php

/**
 * @var \common\models\forms\BookForm $model
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin(['id' => 'books-form']); ?>

<?= $form->field($model, 'id')->hiddenInput()->label(false) ?>

<?= $form->field($model, 'first_name')->textInput() ?>

<?= $form->field($model, 'middle_name')->textInput() ?>

<?= $form->field($model, 'last_name')->textInput() ?>
<br><br>
<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
<?php ActiveForm::end(); ?>
