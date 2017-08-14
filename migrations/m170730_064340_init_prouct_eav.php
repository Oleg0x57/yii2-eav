<?php

use yii\db\Migration;

class m170730_064340_init_prouct_eav extends Migration
{
    public function safeUp()
    {
        $this->createTable('product_property', ['id' => $this->primaryKey(), 'title' => $this->string()]);
        $this->createTable('product_property_value', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'property_id' => $this->integer(),
            'value' => $this->text()
        ]);
        $this->addForeignKey('fk_product_property_value_product_id', 'product_property_value', 'product_id', 'product', 'id');
        $this->addForeignKey('fk_product_property_value_property_id', 'product_property_value', 'property_id', 'product_property', 'id');
    }

    public function safeDown()
    {
        $this->dropTable('product_property_value');
        $this->dropTable('product_property');

        return true;
    }
}
