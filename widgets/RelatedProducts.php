<?php

Yii::import('application.modules.relatedproduct.models.StoreProduct');

class RelatedProducts extends yupe\widgets\YWidget
{
    public $view = 'relatedproduct';
    public $limin = 4;
    public $modelId;
    public $title = 'Сопутствующие товары';

    public function run()
    {
        $criteria = new CDbCriteria;
        $criteria->with = 'relationTo';
        $criteria->together = true;
        $criteria->compare('relationTo.id', $this->modelId);
        $criteria->limit = $this->limit;
        
        $model = StoreProduct::model()->findAll($criteria);

        $this->render($this->view, [
            'model'=>$model
        ]);
    }
}
?>