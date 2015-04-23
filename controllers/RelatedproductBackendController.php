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
        $this->pageTitle = $model->name;
        $model = StoreProduct::model()->findByPk($id);
        if (isset($_POST['StoreProduct'])) {
            $model->setAttributes($_POST['StoreProduct']);
            if ($model->updateRel()) {
                Yii::app()->getUser()->setFlash(
                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                    'Сопутствующие товары успешно сохранены'
                );
            }
        }

        $grid = new StoreProduct('search');
        $grid->unsetAttributes(); // clear any default values
        if (isset($_GET['StoreProduct'])) {
            $grid->attributes = $_GET['StoreProduct'];
        }
        $this->render('relation', [
            'model'=>$model,
            'grid'=>$grid,
        ]);
    }

    public function actionAdd($id)
    {
        // echo $id;
        $data = StoreProduct::model()->loadModel($id);
        $this->renderPartial('element',[
            'data'=>$data
        ]);
    }
}