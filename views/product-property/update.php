<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProductProperty */

$this->title = 'Update Product Property: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Product Properties', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-property-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
