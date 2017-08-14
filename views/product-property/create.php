<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProductProperty */

$this->title = 'Create Product Property';
$this->params['breadcrumbs'][] = ['label' => 'Product Properties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-property-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
