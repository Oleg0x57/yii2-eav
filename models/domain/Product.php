<?php

namespace app\models\domain;

use app\models\Product as BaseProduct;
use app\models\ProductProperty;
use app\models\ProductPropertyValue;
use Yii;
use yii\base\Model;

class Product
{
    /* @var BaseProduct */
    private $baseProduct;
    /* @var ProductPropertyValue[] */
    private $extendedAttributes = [];

    /**
     * @param array $data
     * @return bool
     */
    public function createProduct($data)
    {
        $this->baseProduct = new BaseProduct();
        $productProperties = ProductProperty::find()->all();
        foreach ($productProperties as $productProperty) {
            $this->extendedAttributes[] = new ProductPropertyValue(['property_id' => $productProperty->id]);
        }
        if ($this->baseProduct->load($data) && $this->baseProduct->save()) {
            if (Model::loadMultiple($this->extendedAttributes, $data) && Model::validateMultiple($this->extendedAttributes)) {
                foreach ($this->extendedAttributes as $productValue) {
                    $productValue->product_id = $this->baseProduct->id;
                    $productValue->save(false);
                }
                return true;
            }
        }
    }

    public function getById($id)
    {
        $this->baseProduct = BaseProduct::findOne($id);
        $productProperties = ProductProperty::find()->all();
        foreach ($productProperties as $productProperty) {
            $this->extendedAttributes[] = ProductPropertyValue::findOne([
                'product_id' => $id,
                'property_id' => $productProperty->id
            ]);
        }
        return $this;
    }

    public function updateProduct($data)
    {
        if ($this->baseProduct->load($data) && $this->baseProduct->save()) {
            if (Model::loadMultiple($this->extendedAttributes, $data) && Model::validateMultiple($this->extendedAttributes)) {
                foreach ($this->extendedAttributes as $productValue) {
                    $productValue->save(false);
                }
                return true;
            }
        }
    }

    public function getExtendedAttributes()
    {
        return $this->extendedAttributes;
    }

    public function getBaseProduct()
    {
        return $this->baseProduct;
    }

    public function getId()
    {
        return $this->baseProduct->id;
    }

    public function getTitle()
    {
        return $this->baseProduct->title;
    }

    public function getDescription()
    {
        return $this->baseProduct->description;
    }
}