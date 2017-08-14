<?php

namespace app\controllers;

use app\models\ProductProperty;
use app\models\ProductPropertyValue;
use Yii;
use app\models\Product;
use app\models\ProductSearch;
use yii\base\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $productProperties = ProductProperty::find()->all();
        $productValues = [];
        foreach ($productProperties as $productProperty) {
            $productValues[] = ProductPropertyValue::findOne([
                'product_id' => $id,
                'property_id' => $productProperty->id
            ]);
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
            'productValues' => $productValues,
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();
        $productProperties = ProductProperty::find()->all();
        $productValues = [];
        foreach ($productProperties as $productProperty) {
            $productValues[] = new ProductPropertyValue(['property_id' => $productProperty->id]);
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if (Model::loadMultiple($productValues, Yii::$app->request->post()) && Model::validateMultiple($productValues)) {
                foreach ($productValues as $productValue) {
                    $productValue->product_id = $model->id;
                    $productValue->save(false);
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'productValues' => $productValues,
            ]);
        }
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $productProperties = ProductProperty::find()->all();
        $productValues = [];
        foreach ($productProperties as $productProperty) {
            $productValues[] = ProductPropertyValue::findOne([
                'product_id' => $id,
                'property_id' => $productProperty->id
            ]);
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if (Model::loadMultiple($productValues, Yii::$app->request->post()) && Model::validateMultiple($productValues)) {
                foreach ($productValues as $productValue) {
                    $productValue->save(false);
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'productValues' => $productValues,
            ]);
        }
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
