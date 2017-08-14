<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_property".
 *
 * @property integer $id
 * @property string $title
 *
 * @property ProductPropertyValue[] $productPropertyValues
 */
class ProductProperty extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_property';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductPropertyValues()
    {
        return $this->hasMany(ProductPropertyValue::className(), ['property_id' => 'id']);
    }
}
