<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\domain\Product */
/* @var $productValues app\models\ProductPropertyValue[] */

$this->title = $model->getBaseProduct()->title;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
$extendedAttributes = [];
foreach ($model->getExtendedAttributes() as $productValue) {
    $extendedAttributes[] = [
        'label' => $productValue->property->title,
        'value' => $productValue->value,
    ];
}
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->getId()], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->getId()], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => array_merge([
            ['label' => 'id', 'value' => $model->getId()],
            ['label' => 'title', 'value' => $model->getTitle()],
            ['label' => 'description', 'value' => $model->getDescription()]
        ], $extendedAttributes),
    ]) ?>

</div>
