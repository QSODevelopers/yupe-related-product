<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	Yii::t('RelatedproductModule.relatedproduct', 'Related products'),
);
?>
<h1><?php echo Yii::t('RelatedproductModule.relatedproduct', 'Related products'); ?></h1>

<div class="col-md-12">
    <?php 
        $this->widget('bootstrap.widgets.TbGridView', [
            'dataProvider' => $model->search(),
            'filter' => $model,
            'columns'=>[
                'name',
                [
                    'name' => 'price',
                    'value' => function ($data) {
                        return (float)$data->price;
                    },
                    'filter' => CHtml::activeTextField($model, 'price', ['class' => 'form-control']),
                ],
                [
                    'name' => 'in_stock',
                    'filter' => Product::model()->getInStockList(),
                    'value'=>'Product::model()->getInStockList()[$data->in_stock]'
                ],
                [
                    'name' => 'status',
                    'filter' => Product::model()->getStatusList(),
                    'value'=>'Product::model()->getStatusList()[$data->status]'
                ],
                [
                    'class' => 'bootstrap.widgets.TbButtonColumn',
                    'viewButtonIcon'=>'fa fa-fw fa-arrows-h',
                    'template'=>'{view}',
                    'viewButtonUrl'=>'Yii::app()->controller->createUrl("relation",array("id"=>$data->primaryKey))'
                ],
            ]
        ]);
     ?>
</div>