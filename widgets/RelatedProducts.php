<?php

Yii::import('application.modules.relatedproduct.models.StoreProduct');

class RelatedProducts extends yupe\widgets\YWidget
{
    public $view = 'relatedproduct';
    public $limin = 4;
    public $modelId;

    public function run()
    {
        $criteria = new CDbCriteria;
        $criteria->with = 'relationTo';
        $criteria->together = true;
        $criteria->compare('relationTo.id', $this->modelId);
        
        $model = StoreProduct::model()->findAll($criteria);

        $this->render($this->view, [
            'model'=>$model
        ]);
    }
}
?>