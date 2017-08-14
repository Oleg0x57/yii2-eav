<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Product]].
 *
 * @see Product
 */
class ProductQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Product[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Product|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function withPropertiesAndValues()
    {
        $this
            ->leftJoin(ProductProperty::tableName(), true)
            ->leftJoin(ProductPropertyValue::tableName(), Product::tableName() . '.id = ' . ProductPropertyValue::tableName() . '.product_id AND ' . ProductProperty::tableName() . '.id = ' . ProductPropertyValue::tableName() . '.property_id');
        return $this;
    }
}
