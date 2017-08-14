<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\domain\Product */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model->getBaseProduct(), 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model->getBaseProduct(), 'description')->textarea(['rows' => 6]) ?>

    <?php foreach ($model->getExtendedAttributes() as $index => $productValue) : ?>
        <?= $form->field($productValue, "[$index]value")->label($productValue->property->title) ?>
        <?= $form->field($productValue, "[$index]property_id")->hiddenInput()->label(false) ?>
    <?php endforeach; ?>


    <div class="form-group">
        <?= Html::submitButton($model->getBaseProduct()->isNewRecord ? 'Create' : 'Update', ['class' => $model->getBaseProduct()->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
