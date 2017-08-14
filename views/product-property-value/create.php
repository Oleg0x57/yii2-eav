<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProductPropertyValue */

$this->title = 'Create Product Property Value';
$this->params['breadcrumbs'][] = ['label' => 'Product Property Values', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-property-value-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
