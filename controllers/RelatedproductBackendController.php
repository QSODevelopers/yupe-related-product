<?php

class RelatedproductBackendController extends yupe\components\controllers\BackController
{
	public function actionIndex()
	{
        $this->pageTitle = Yii::t('RelatedproductModule.relatedproduct', 'Related products list');
        $model = new StoreProduct('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['StoreProduct'])) {
            $model->attributes = $_GET['StoreProduct'];
        }
        $this->render('index', [
            'model'=>$model
        ]);
    }

    public function actionRelation($id)
    {
        $model = Product::model()->findByPk($id);
        $this->pageTitle = Yii::t('RelatedproductModule.relatedproduct', 'Related products');
        $this->render('relation', [
            'model'=>$model
        ]);
    }
}