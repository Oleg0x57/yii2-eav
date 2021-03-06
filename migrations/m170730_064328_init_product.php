<?php

use yii\db\Migration;

class m170730_064328_init_product extends Migration
{
    public function safeUp()
    {
        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'description' => $this->text()
        ]);
        Yii::$app->db->createCommand()->batchInsert('product', ['title', 'description',], [
            [
                'Вино',
                'алкогольный напиток (крепость: натуральных — 9—16 % об., креплёных — 16—22 % об.), получаемый полным или частичным спиртовым брожением виноградного сока (иногда с добавлением спирта и других веществ — так называемое «креплёное вино»). Наука, изучающая вина, — энология.',
            ],
            [
                'Сыр',
                'пищевой продукт, получаемый из сыропригодного молока с использованием свёртывающих молоко ферментов и молочнокислых бактерий или путём плавления различных молочных продуктов и сырья немолочного происхождения с применением солей-плавителей.',
            ],
            [
                'Хлеб',
                'пищевой продукт, получаемый путём выпечки, паровой обработки или жарки теста, состоящего, как минимум, из муки и воды. В большинстве случаев добавляется соль, а также используется разрыхлитель, такой как дрожжи.',
            ],
        ])->execute();
    }

    public function safeDown()
    {
        $this->dropTable('product');
        return true;
    }
}
